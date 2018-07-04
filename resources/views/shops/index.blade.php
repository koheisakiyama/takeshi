@extends ('layout')

@section ('content')

  <div id="map" style="height:100%;"></div>

  <script>
    var map;
    var lat = 35.628;
    var lng = 139.736571;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: lat, lng: lng},
        zoom: 14
      });
    }
  </script>

@endsection
