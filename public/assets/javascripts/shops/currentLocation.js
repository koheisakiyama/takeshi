// なぜ＄あるとうまく動くのか・・・・・・initMapしたら解決したが、＄マークがつくとinitMapしていなくても実行される理由はわからないまま。→＄がjqueryをつかって実行、の意味。
function drawUserMarker(LatLng) {
  userMarker = new google.maps.Marker({
            icon: {
              path: google.maps.SymbolPath.CIRCLE, 
              scale: 4
            },
            map : map,             // 対象の地図オブジェクト
            position : LatLng,   // 緯度・経度
  });
}
