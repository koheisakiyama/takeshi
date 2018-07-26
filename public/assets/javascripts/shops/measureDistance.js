// 直線距離の計算
function measureDis(latlng1, latlng2){
  var distance = Math.sqrt(
                    Math.pow((latlng1.lat() - latlng2.lat()) * 110946.2521, 2)
                  + Math.pow((latlng1.lng() - latlng2.lng()) *  90881.8492, 2)
  );
  console.log(distance);
  return distance;
}
