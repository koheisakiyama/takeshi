@extends ('layout')

@section ('content')


  <div id="map" style="height:100%;"></div>

  <!--
  <script>
    var map=null;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 35.6284, lng: 139.736571},
        zoom: 14
      });
    }
  </script>
  -->
  <script src="{{ asset('assets/javascripts/currentLocation.js') }}"></script>

@endsection
