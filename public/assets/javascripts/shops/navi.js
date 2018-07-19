function displayRoute(result, status) {
  var directionsRenderer = new google.maps.DirectionsRenderer();
  directionsRenderer.setDirections(result); // 取得したルートをセット
  directionsRenderer.setMap(map); // ルートを地図に表示

  route = result.routes[0].legs[0].steps;
  console.log(result.routes[0].legs[0].duration.text);
  for (var i in route) {
    steps.push({
      latlng  : route[i].start_location, // ステップの緯度を取得
      comment : route[i].instructions, // ステップの説明を取得
      duration: route[i].duration.text, // ステップの時間を取得
      distance: route[i].distance.text, // ステップの距離を取得
    });
  }
  console.log(steps.length);
  directionsRenderer.setPanel(document.getElementById('directions_panel')); // 道順を表示する k-koda
}

function startNavi(position) {
  // 地図とユーザーのマーカーの作成と表示
  currentLocation(position);

  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得
  var g_latlng = new google.maps.LatLng(g_ll); 
  var directionsService = new google.maps.DirectionsService();

  switch("transit"){
    case "driving":
          modeType = google.maps.DirectionsTravelMode.DRIVING; // 自動車
          break;
    case "transit":
          modeType = google.maps.DirectionsTravelMode.TRANSIT; // 電車
          break;
    case "bicycling":
          modeType = google.maps.DirectionsTravelMode.BICYCLING // 自転車
          break;
    default: // デフォルトは徒歩
          modeType = google.maps.DirectionsTravelMode.WALKING; // 徒歩
          break;
    
  }
  // ルートの設定
  var request = {
    origin:      current,   // 出発地点の緯度、経度
    destination: g_latlng,   // 到着地点の緯度、経度
    travelMode:  modeType,// ルートの種類
  };
  // ルートを取得
  directionsService.route(request, function(result, status){
    displayRoute(result, status);
    insertModal(steps[0]);
  });
}

// 移動した時の現在地をマーカーで表示
function navigation(position){ 
  var g_latlng = new google.maps.LatLng(g_ll); 
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得

  errCir.setMap(null); // すで表示されている円を削除
  userMarker.setMap(null); // すで表示されているを削除
  // マーカーの作成と表示
  drawUserMarker(position);

  // 2018/07/12 ここまで直線距離を計算する (m)
  //console.log(steps[stepNum]);
  var dffDistance = null;
  if( stepNum == steps.length){
    dffDistance = measureDis(current, g_latlng);
    if (dffDistance < 50.) {// 近かったらmodalを表示
      $('#naviComplete').modal();
    }
  }else{
    dffDistance = measureDis(current, steps[stepNum].latlng);
    if (dffDistance < 50.) {// 近かったらmodalを表示
      insertModal(steps[stepNum]);
      stepNum++;
    }
  }
}

function insertModal(step){
  console.log(steps.length);
  document.getElementById('step_comment').innerHTML=step.comment;
  document.getElementById('step_duration').innerHTML=step.duration;
  document.getElementById('step_distance').innerHTML=step.distance;
  $('#naviModal').modal();
  stepNum++
}
 
function measureDis(latlng1, latlng2){
  var distance = Math.sqrt(
                    Math.pow((latlng1.lat - latlng2.lat) * 110946.2521, 2)
                  + Math.pow((latlng1.lng - latlng2.lng) *  90881.8492, 2)
    );
  return distance;
}
