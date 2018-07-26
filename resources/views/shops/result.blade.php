@extends ('layout')

@section ('content')

  <div id="map" style="height:75%;width:100%"></div>
  <div class="result-list pre-scrollable" style="height:25%;">
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
            <p style="float: left; font-size: 16px;">{{ $shop->time }}</p>
            <p style="font-size: 18px; margin-left: 15px; color: #F0F0F0">/</p>
          @if ( $shop->link == "なし")
            <p>URLないです</p>
          @else
            <a href="{{ $shop->link }}" style="font-size: 17px; color: #6495ED" data-user="{{Auth::user()->id}}" data-shop="{{$shop->id}}" method="POST" class="post">店舗情報</a>
            <input type="text" name="shop_id" id="shop_id" value="{{$shop->id}}">
            <input type="text" name="user_id" id="user_id" value="{{Auth::user()->id}}">
            <input type="submit" >

          @endif
            <a href="/navi/{{ $shop->id }}" style="font-size: 17px; color: #6495ED">ナビの開始</a>
          </li>
        @endforeach
      </ul>
  </div>

<script>
  $('.post').on('click', function(){
      post($(this).data('user'), $(this).data('shop'));
  });
</script>

  <script type="text/javascript">
    var areaLatLng = <?php echo json_encode($latlng); ?> ;
    // var latlng = <?php echo json_encode($latlng); ?> ;
    var shops= <?php echo json_encode($shops); ?> ;
    displayShops(areaLatLng);
  </script>

@endsection
