function startNavi(position) {
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得

  //出発地をidから引き出したlatlonに代入する
  var s_latlng = current;
  var g_latlng = new google.maps.LatLng(g_ll); 
  var center = new google.maps.LatLng(s_ll); 
  var directionsService = new google.maps.DirectionsService();
  var directionsRenderer = new google.maps.DirectionsRenderer();

  // ルートを取得
  var request = {
    origin:      s_latlng,   // 出発地点の緯度、経度
    destination: g_latlng,   // 到着地点の緯度、経度
    //travelMode: google.maps.DirectionsTravelMode.DRIVING // ルートの種類
    travelMode: google.maps.DirectionsTravelMode.WALKING // ルートの種類
  };
  directionsService.route(request, directionNavi);

  // 誤差を円で描く
  errPos = position.coords.accuracy; // 位置の誤差を取得
  errCir = new google.maps.Circle(cirOpt);
  errCir.setMap(map);
}

function directionNavi(result, status) {
  directionsRenderer.setDirections(result); // 取得したルートをセット
  directionsRenderer.setMap(map); // ルートを地図に表示
  directionsRenderer.setPanel(document.getElementById('directions_panel')); // 道順を表示する k-koda

  var route = result.routes[0].legs[0].steps;
  console.log(stepNum);
  for(var i in route){
    console.log(i);
    steps[i]({
      latlng : route[i].start_location, // ステップの緯度を取得
      instruction : route[i].instructions, // ステップの説明を取得
      duration : route[i].duration.text, // ステップの時間を取得
      distance : route[i].distance.text, // ステップの距離を取得
    });
  }
  stepNum++;
  //insertInst(steps[stepNum]);
}

// 移動した時の現在地をマーカーで表示
function navigation(position){ 
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得
  // マーカーの作成と表示
  drawMarker(position);
  errCir.setMap(null); // すで表示されている円を削除
  errPos = position.coords.accuracy; // 位置の誤差を取得
  // 2018/07/12 ここまで直線距離を計算する
  var distance = calDistance(current, steps[stepNum].latlng);
  // 近かったらmodalを表示
  if (distance < 50.) {
    //insertInst(steps[stepNum]);
    stepNum++;
  }
}

function calDistance({lat:lat1, lng:lng1}, {lat:lat2, lng:lng2}){
  var diffLat = lat1 - lat2;
  var diffLng = lng1 - lng2;
  var disLat = Math.pow(111263.283 * diffLat,2);
  var disLng = Math.pow(90881.8492 * diffLng,2);
  var distance = Math.sqrt(disLat+disLng);
  return distance;
}

//$(function insertInst(step){
//  document.getElementById('step_comment').innerHTML = step.instruction;
//  document.getElementById('step_duration').innerHTML= step.duration;
//  document.getElementById('step_distance').innerHTML= step.distance;
//  console.log(step.instruction);
//  $('#sampleModal').modal();
//});
