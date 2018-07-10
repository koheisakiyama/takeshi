
  $(function currentLocation() {
      var loc = new Array();
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
          function(position) {

            loc['cLat'] = pos.coords.longitude; 
            loc{'cLon'} = pos.coords.latitude;
            return();
        // 取得した現在地のlatlonを取り出して、resultページなどに送ろうか画策中です。。。07/10
        // 現在地が必要そうなページでここで発行したlatlonを受け取り、各mapに表示させる計画。
        
          },
          function(error) {
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
        );
      } else {
        alert("この端末では位置情報が取得できません");
      }
    });