// 現在地取得、検索でヒットしたshopsを回して地図上にマーカーを指す
function displayShops(latlng) {
  const pro1 = new Promise(
    function (resolve, reject){
      // 地図とユーザーのマーカーの作成と表示
      navigator.geolocation.getCurrentPosition(
          function (position){
            current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            if(null == latlng){
              center = current;
            } else {
              center =  new google.maps.LatLng(latlng);
            }
            initMap(center);
            drawUserMarker(position);
            resolve();
          },
          errorCallback,
          getOpt
      );
    }
  );
//検索結果の緯度経度にマーカを指し、それぞれの現在地からの距離を測定してビューファイルに投げる
  pro1.then(
    function(){
      var shopMarkers = new Array();
      var infoWindows = new Array();
      for(var i in shops) {
        var shopLatLng = new google.maps.LatLng(shops[i].lat, shops[i].lon);
        var content = '<div>'
                      +'<h3>'+shops[i].name+'</h3>'
                      + '<p>'
                        +'住所:<span>'+shops[i].address+'</span><br>'
                        +'詳細:<span><a href='+shops[i].link+'>'+shops[i].link+'</a></span><br>'
                        +'営業時間:<span>'+shops[i].time+'</span><br>'
                      +'</p>'
                    + '</div>';

        var shopMarker = new google.maps.Marker({
                              position:shopLatLng, 
                              map:map,
                              titel:"TITLE",
                              summary:"summary",
                         });
        var infoWindow = new google.maps.InfoWindow({
                              lat: shops[i].lat,
                              lng: shops[i].lon,
                              content: content,
        });
        let distance = Math.floor(google.maps.geometry.spherical.computeDistanceBetween(current,shopLatLng));
        //現在地と店の緯度経度から２点間距離を測る
        document.getElementById('shop_' + shops[i].id).innerHTML= distance; //jsファイルからビューファイルに数を渡す
        shopMarkers[i] = shopMarker;
        infoWindows[i] = infoWindow;
        shopMarkers[i].addListener('click', function() { // マーカーをクリックしたとき
          infoWindows[i].open(map, shopMarkers[i]); // 吹き出しの表示
        });
      }
      google.maps.event.addListener(marker[i], 'click', function(e) {
        for(var i = 0; i < markers.length; i++) {
          if(marker[i].position.G == e.latLng.G && marker[i].position.K == e.latLng.K) {
            //クリックしたマーカーだったら詳細を表示
            infoWindow[i].open(map, marker[i]);
          } else {
            //クリックしたマーカーでなければ詳細を閉じる
            infoWindow[i].close();
          }
        }
      });
    }
  );
}

//History DB に閲覧履歴を保存しつつ、店舗詳細のリンク先に遷移する
function post(user, shop) {　
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "/result",
    data: {
          'user_id' : user,
          'shop_id' : shop
    },
  }).done(function(){
    // 一旦何も書かずにやってみる
  });
}
