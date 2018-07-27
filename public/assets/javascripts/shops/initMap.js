function initMap(latlng) {
  // 地図初期化のオプション
  var mapOpt = {
    zoom : 15,        // 拡大倍率
    center : latlng,  // 緯度・経度
    //mapTypeId: google.maps.MapTypeId.ROADMAP,
  };
  map = new google.maps.Map(
    document.getElementById("map"), // マップを表示する要素
    mapOpt         // マップオプション
  );
};
