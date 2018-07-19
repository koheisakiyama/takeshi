function displayRoute(latlng1, latlng2, modeType) {
  // 地図とユーザーのマーカーの作成と表示
  if(null == s_latlng) {
    currentLocation(position);
    current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得
  }
  var s_latlng = current;
   
  var directionsService = new google.maps.DirectionsService();

  switch(modeType){
    case "driving":
      travelMode=google.maps.DirectionsTravelMode.DRIVING;
      break;
    case "bicycling":
      travelMode=google.maps.DirectionsTravelMode.BICYCLING;
      break;
    case "transit":
      travelMode=google.maps.DirectionsTravelMode.TRANSIT;
      break;
    default:
      travelMode=google.maps.DirectionsTravelMode.WALKING;
      break;
  }
  var request={
      origin:,         /* 出発地点 */
      destination:new google.maps.LatLng(latlng2),      /* 到着地点 */
      travelMode:travelMode            /* 交通手段 */
  };
  // ルートを取得
  directionsService.route(request, function(result, status){
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
  });
}

function startNavi(result, status) {
    insertModal(steps[0]);
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
