// route.blade.phpが引っ張ってくる、ルート表示を行うjavascriptの記述ページ。　seina2018/06/28

$(function() {
    //出発地をidから引き出したlatlonに代入する
    var lat1 = <?php echo json_encode($lat1); ?>; //json_encode部分はいらないかも
    var lon1 = <?php echo $lon1; ?>;
    var lat2 = <?php echo $lat2; ?>;
    var lon2 = <?php echo $lon2; ?>;
console.log(lat1);

    var latlng1 = new google.maps.LatLng(lat1, lon1); 
    var latlng2 = new google.maps.LatLng(lat2, lon2); 
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