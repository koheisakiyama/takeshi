// なぜ＄あるとうまく動くのか・・・・・・initMapしたら解決したが、＄マークがつくとinitMapしていなくても実行される理由はわからないまま。

   function initMap() {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
          }else {
        alert("この端末では位置情報が取得できません");
      }

          function successCallback(position) {
            var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            var mapOptions = {
              zoom : 15,          // 拡大倍率
              center : mapLatLng  // 緯度・経度
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
              position : mapLatLng,   // 緯度・経度
            });
          }

          function errorCallback(error) {
            switch(error.code) {
              case 1: // PERMISSION_DENIED
                alert("位置情報の利用が許可されていません");
                break;
              case 2: // POSITION_UNAVAILABLE
                alert("現在位置が取得できませんでした");
                break;
              case 3: // TIMEOUT
                alert("タイムアウトになりました");
                break;
              default:
                alert("その他のエラー(エラーコード:"+error.code+")");
                break;
            }
          }
  }