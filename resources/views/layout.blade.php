<!DOCTYPE html>
<html>
  <head>
    <title>QR Map</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/bootstrap-multiselect.css')}}" rel='stylesheet' type='text/css'>
    <script src="{{ asset('assets/javascripts/jquery-3.3.1.js') }}"></script>
    <script src = "{{ asset('assets/javascripts/bootstrap.min.js') }}"></script>
    <script src = "{{ asset('assets/javascripts/bootstrap-multiselect.js') }}"></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      html, body, div.row-fluid, div.container-fluid{
        height: 100%;
        margin: 0;
        padding: 0;
      }
       #navTgl:checked ~ .contents {
          -webkit-transform: translateY(250px);
        transform: translateY(250px);
      }
      #navTgl {
        display: none;
        overflow: hidden;
      }
      .open {
        z-index: 2;
        width: 150px;
        height: 30px;
        color: white;
        background-color: #A3D1FF;
        font-size: 2em;
        line-height: 50px;
        text-align: center;
        -webkit-transition: background-color .6s, -webkit-transform .6s;
        transition: background-color .6s, transform .6s;
       }
       #navTgl:checked + .open {
        background-color: indianRed;
        -webkit-transform: translateY(-500px);
        transform: translateY(-500px);
       }
       .close {
        pointer-events: none;
        z-index: 1;
        width: 100%;
        height: 100%;
        transition: background-color .6s;
       }
       #navTgl:checked ~ .close {
        pointer-events: auto;
        background-color: rgba(0,0,0,.3);
       }
       .search-result {
          z-index: 1;
          position: fixed;
          overflow: auto;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          padding: 10px;
          background-color: rgba(0,0,0,.6);
          -webkit-transform: translateY(100%);
          transform: translateY(100%);
          -webkit-transition: -webkit-transform .6s;
          transition: transform .6s;
       }
        #navTgl:checked ~ .search-result {
          -webkit-transform: translateY(250px);
          transform: translateY(250px);
        }
        .search-result h3 {
          color: white;
          text-align: center;
        }
    </style>
  </head>

  <body> 
    <!-- <header class="page-header"> -->
      <!-- <h1> -->
        <!-- <div align="center"> -->
        <!-- <a href="" class="center-block">pay serch</a> -->
      <!-- </div><div align="center"> -->
      <!-- </h1> -->
    <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #A3D1FF;">
      <div class="container-fluid">
        <div class="navbar-header">
          <!-- <a class="navbar-brand" href="#">Bootstrap3 チュートリアル</a> -->
        </div>
       {{ Form::open(['action' => 'ShopsController@result', 'method' => 'get']) }}
        <ul class="nav navbar-nav" style="padding: 0px;">
          <li class="active"><a href="/index" style="padding: 0;background-color: #A3D1FF; margin:0;"><h1 style="margin: 10px;">pay search</h1></a></li>
          <li><a href="#">@include ('shops.details.how')</a></li>
          <li><a href="#">@include ('shops.details.what')</a></li>
          <li><a href="#">@include ('shops.details.where')</a></li>
          <li><a href="#">{{ Form::submit('検索', ['class' => 'btn btn-primary navbar-form']) }}</a></li>
        </ul>
        {{ Form::close() }}
      </div>
    </nav>
    
    <div class="container-fluid">
      <div class="row-fluid"> 
        @yield ('content')
    <!-- jsファイルを作成　seina -->
    <!-- <script src= "{{ asset('assets/javascripts/currentLocation.js') }}"></script> -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('Google_API_Key') }}&callback=initMap"></script>
      </div>
    </div>
  </body>
</html>
