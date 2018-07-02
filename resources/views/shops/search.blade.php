@extends ('layout')

@section ('content')
  <div class="container">
   {{ Form::open(['action' => 'ShopsController@result', 'method' => 'get']) }}
    <div style="width:25%;">
      @include ('shops.details.how')
    </div>
    <div style="width:25%;">
      @include ('shops.details.what')
    </div>
    <div style="width:25%;">
      @include ('shops.details.where')
    </div>
      {{ Form::submit('検索', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
  </div>
  <div id="map" style="height:100%;"></div>

  <script>
    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 35.6284, lng: 139.736571},
        zoom: 14
      });
    }
  </script>

@endsection
