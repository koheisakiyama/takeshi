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
