// function initMap(position) {
//   mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
//   map = new google.maps.Map(document.getElementById('map'),
//     { center: ll, zoom: 15}
//   );

//   for(var i in shops) {
//     marker = new google.maps.Marker({ 
//       position:{lat:shops[i].lat, lng:shops[i].lon}, 
//       map:map
//     });
//   }

//   userMarker = new google.maps.Marker({
//             icon: {
//               path: google.maps.SymbolPath.CIRCLE, 
//               scale: 4
//             },
//             map : map,             // 対象の地図オブジェクト
//             position : mapLatLng,   // 緯度・経度
//   });
// }

function displayResult(LatLng) {
  for(var i in shops) {
    marker = new google.maps.Marker({
      position:{lat:shops[i].lat, lng:shops[i].lon},
      map:map
    });
  }
}
