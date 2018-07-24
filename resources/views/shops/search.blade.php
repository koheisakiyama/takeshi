@extends ('layout')

@section ('content')

  <div id="map" style="height:100%;width:100%;"></div>
  <script type="text/javascript">
    navigator.geolocation.getCurrentPosition(currentLocation,errorCallback,getOpt);
  </script>

@endsection
