@extends ('layout')

@section ('content')

  <div id="map" style="height:75%;width:100%"></div>
  <div class="result-list pre-scrollable" style="height:25%;">

    <script type="text/javascript">
      var shops = <?php echo json_encode($shops); ?>;
    </script>

    <!--
      <input type="checkbox" id="navTgl">
      <label for="navTgl" class="open">≡</label>
      <label for="navTgl" class="close"></label>
      <div class="search-result">
      </div>
      -->

    <table class="table table-bordered table-striped" style="width:100%">
      @foreach ($shops as $shop)
        <tbody style="border:solid medium">
          <tr>
            <th class="shop-name-box" data-shop="{{$shop->id}}" style="font-size: 18px; font-weight: bold; color: #4169E1">{{ $shop->name }}</th>
            <th style="font-size: 16px; margin-left: 40px;"> 現在地からの距離：<span id = "shop_{{$shop -> id}}"></span>m</th>
            <th style="font-size: 16px; margin-left: 40px;">{{ $shop->time }}</th>
          </tr>
          <tr>
            <th style="font-size: 16px;">{{ $shop->address }}</th>
            <th>
            @if ( $shop->link == "なし")
              URLないです
            @else
                @if (Auth::check())
                  <a href="{{ $shop->link }}" style="font-size: 17px; color: #6495ED" data-user="{{Auth::user()->id}}" data-shop="{{$shop->id}}" method="POST" class="post">店舗情報</a>
                @else
                  <a href="{{ $shop->link }}" style="font-size: 17px; color: #6495ED">店舗情報</a>
                @endif
            @endif
            </th>
            <th><a href="/select/{{ $shop->id }}" style="font-size: 17px; color: #6495ED">このお店に行きたい</a></th>
          </tr>
        </tbody>
      @endforeach
    </table>

    <script>
      //クリックされた時にhistoryデータベースに店舗情報を保存する処理
      $('.post').on('click', function(){
        post($(this).data('user'), $(this).data('shop'));
      });

      var shopMarkers = new Array();
      var infoWindows = new Array();
      var currentInfoWindow = null;
      var areaLatLng = <?php echo json_encode($latlng); ?>;
      var shops = <?php echo json_encode($shops); ?>;
      displayShops(areaLatLng);
      $('.shop-name-box').on('click',clickObj);
      function clickObj(){
        if(currentInfoWindow){
          currentInfoWindow.close();
        }
        console.log($(this).data('shop'));
        var i = $(this).data('shop');
        infoWindows[i].open(map,shopMarkers[i]);
      }
    </script>

    </div>

@endsection
