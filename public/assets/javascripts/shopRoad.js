// route.blade.phpが引っ張ってくる、ルート表示を行うjavascriptの記述ページ。　seina2018/06/28
$(function() {
    var latlng1 = new google.maps.LatLng(35.705947, 139.651252);  // VAL研究所
    var latlng2 = new google.maps.LatLng(35.705469, 139.649610);  // 高円寺駅
    var map;
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();

    // 地図初期化のオプション
    var mapOptions = {
        zoom: 17,
        center: latlng1,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scaleControl: true,
    };
    // 地図を表示
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    // ルートを取得
    var request = {
      origin: latlng1,        // 出発地点の緯度、経度
      destination: latlng2,   // 到着地点の緯度、経度
      travelMode: google.maps.DirectionsTravelMode.WALKING // ルートの種類
    };
    directionsService.route(request, function(result, status) {
      directionsRenderer.setDirections(result); // 取得したルートをセット
      directionsRenderer.setMap(map); // ルートを地図に表示
    });
  });