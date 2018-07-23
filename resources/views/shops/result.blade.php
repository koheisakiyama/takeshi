@extends ('layout')

@section ('content')

  <div id="map" style="height:75%;width:100%"></div>
  <div class="result-list pre-scrollable" style="height:25%;">
  <script type=" "></script>
  <!--
    <input type="checkbox" id="navTgl">
    <label for="navTgl" class="open">≡</label>
    <label for="navTgl" class="close"></label>
    <div class="search-result">
    </div>
    -->
      <ul class="list-group search-result-list" style="margin-bottom:0px;">
        @foreach ($shops as $shop)
          <li class="list-group-item search-result-item" style="background-color: #F0F0F0">
            <p style="float: left; font-size: 18px; font-weight: bold; color: #4169E1">{{ $shop->name }}</p>
            <p style="float: left; font-size: 18px; margin-right: 15px;"></p>
            <p style="float: left; font-size: 16px;">{{ $shop->address }}</p>
            <p style="float: left; font-size: 18px; margin-right: 15px; margin-left: 15px;">/</p>
            <!-- <script>ここに現在地と店のlatlonnngを取得、現在地と各店舗の差を計算した結果を表示する。foreachが実行されるのは確認済み

//g_latlng=店の緯度経度。
 //処理を順番に行う処理。
    function func1(){
     return new Promise(
       function (resolve, reject){
         console.log(current);
         //デフォルトで出発地を現在地に。現在地取得処理でgetしたlatlngを取得する
         resolve(現在地のlatlngをfuc2に引数として渡す。);
       });
   }

   function func2(hoge){
    //三平方の定理？　出発地とlatlngの差を求めて現在地からの距離を出す。
   }
   func1().then(func2);
   //差を投げる。それぞれの店舗情報のところで実行する。

const pro1 = new Promise(
     function (resolve, reject){
       var hoge=‘hoge’;
       console.log(hoge);//１個めの処理
       resolve(hoge);//２への引数
     }
   );
   pro1.then(function(hoge){
         console.log(‘fuga’+hoge); //２個めの処理
     }
   );
            </script> -->
            <p style="float: left; font-size: 16px;">{{ $shop->time }}</p>
            <p style="font-size: 18px; margin-left: 15px; color: #F0F0F0">/</p>
          @if ( $shop->link == "なし")
            <p>URLないです</p>
          @else
            <a href="{{ $shop->link }}" style="font-size: 17px; color: #6495ED">店舗情報</a>
          @endif
            <a href="/navi/{{ $shop->id }}" style="font-size: 17px; color: #6495ED">ルート探索</a>
            <p>ーーーーーーーーーー現在地からの距離：mーーーーーーーーーー</p>
          </li>
        @endforeach
      </ul>
  </div>

  <script type="text/javascript">
    var areaLatLng = <?php echo json_encode($latlng); ?> ;
    //var latlng = <?php echo json_encode($latlng); ?> ;
    var shops = <?php echo json_encode($shops); ?> ;
    displayShops(areaLatLng);

  </script>

@endsection
