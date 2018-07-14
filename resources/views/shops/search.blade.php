@extends ('layout')

@section ('content')


  <div id="map" style="height:100%;width:100%;"></div>
  <script src="{{ asset('assets/javascripts/shops/currentLocation.js') }}"></script>
  <script type="text/javascript">
    navigator.geolocation.getCurrentPosition(initMap,errorCallback);
  </script>

@endsection
