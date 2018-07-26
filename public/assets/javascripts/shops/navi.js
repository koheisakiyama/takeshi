function displayRoute(latlng1, latlng2, modeType) {
  var s_latlng = null;
  var g_latlng = null;
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
  const pro1 = new Promise(
    function (resolve, reject){
      // 地図とユーザーのマーカーの作成と表示
      navigator.geolocation.getCurrentPosition(
        function(position){
          current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
          if(null==latlng1){
            s_latlng = current;
          } else {
            s_latlng = new google.maps.LatLng(latlng1);
          }
          g_latlng = new google.maps.LatLng(latlng2);
          initMap(s_latlng);
          var latlngs = new Array(s_latlng, g_latlng);
          drawUserMarker(position);
          resolve(latlngs);
        }, 
        errorCallback,
        getOpt
      );
    }
  );
  pro1.then(function(latlngs){
    var request={
        origin:      latlngs[0],      /* 出発地点 */
        destination: latlngs[1],      /* 到着地点 */
        travelMode:  travelMode            /* 交通手段 */
    };
    // ルートを取得
    var directionsService = new google.maps.DirectionsService();
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
          // 道順を表示する
          var tr_element = document.createElement("tr");
          var addContent = "<th scope='row'>" + i + "</th>"
                         + "<th>" + route[i].instructions  + "</th>"
                         + "<th>" + route[i].duration.text + "</th>"
                         + "<th style='text-align:center'>" + route[i].distance.text + "</th>";
          tr_element.innerHTML = addContent;
          var parent_object = document.getElementById("direction-table-body");
          parent_object.appendChild(tr_element);
        }
    });
  });
}

function startNavi() {
    var watchId = navigator.geolocation.watchPosition(navigation, errorCallback, getOpt);
}

// 移動した時の現在地をマーカーで表示
function navigation(position){ 
  var g_latlng = new google.maps.LatLng(g_ll); 
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得
  console.log(current);

  errCir.setMap(null); // すで表示されている円を削除
  userMarker.setMap(null); // すで表示されているを削除
  // マーカーの作成と表示
  drawUserMarker(position);

  // 2018/07/12 ここまで直線距離を計算する (m)
  //console.log(steps[stepNum]);
  var dffDistance = 0.;
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


// ポップアップの表示

function insertModal(step){
  console.log(steps.length);
  document.getElementById('step_comment').innerHTML=step.comment;
  document.getElementById('step_duration').innerHTML=step.duration;
  document.getElementById('step_distance').innerHTML=step.distance;
  $('#naviModal').modal();
  stepNum++
}
 
// 直線距離の計算

function measureDis(latlng1, latlng2){
  var distance = Math.sqrt(
                    Math.pow((latlng1.lat() - latlng2.lat()) * 110946.2521, 2)
                  + Math.pow((latlng1.lng() - latlng2.lng()) *  90881.8492, 2)
  );
  console.log(distance);
  return distance;
}
