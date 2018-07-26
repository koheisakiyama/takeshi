function getLatLng(place) {
  // ジオコーダのコンストラクタ
  var geocoder = new google.maps.Geocoder();
  // geocodeリクエストを実行。
  // 第１引数はGeocoderRequest。住所⇒緯度経度座標の変換時はaddressプロパティを入れればOK。
  // 第２引数はコールバック関数。
  geocoder.geocode({
      address: place,
      language:'ja',
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        document.getElementById("startLat").value = results[0].geometry.location.lat();
        document.getElementById("startLng").value = results[0].geometry.location.lng();
      } else {
        GeoCoderError(status)
      }
  });
}

function GeoCoderError(status){
  if (status == google.maps.GeocoderStatus.ERROR) {
    alert("サーバとの通信時に何らかのエラーが発生！");
  } else if (status == google.maps.GeocoderStatus.INVALID_REQUEST) {
    alert("リクエストに問題アリ！geocode()に渡すGeocoderRequestを確認せよ！！");
  } else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
    alert("短時間にクエリを送りすぎ！落ち着いて！！");
  } else if (status == google.maps.GeocoderStatus.REQUEST_DENIED) {
    alert("このページではジオコーダの利用が許可されていない！・・・なぜ！？");
  } else if (status == google.maps.GeocoderStatus.UNKNOWN_ERROR) {
    alert("サーバ側でなんらかのトラブルが発生した模様。再挑戦されたし。");
  } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
    alert("見つかりません");
  } else {
    alert("えぇ～っと・・、バージョンアップ？");
  }
}
