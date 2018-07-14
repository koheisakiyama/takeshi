// なぜ＄あるとうまく動くのか・・・・・・initMapしたら解決したが、＄マークがつくとinitMapしていなくても実行される理由はわからないまま。→＄がjqueryをつかって実行、の意味。
function initMap(position) {
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  var mapOptions = {
    zoom : 15,          // 拡大倍率
    center : current,  // 緯度・経度
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };
  var map = new google.maps.Map(
    document.getElementById("map"), // マップを表示する要素
    mapOptions         // マップオプション
  );
  
  var marker = new google.maps.Marker({
    icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 4
          },
    map : map,             // 対象の地図オブジェクト
    position : current,   // 緯度・経度
  });
}
