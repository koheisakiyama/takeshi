<!-- 出発点・検索に入力された値、目的地・選ばれた店情報の所在地　でルートを表示するviewファイル。  seina2018.6.27-->

@extends('layout')
@section('content')

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('Google_API_Key') }}"></script> -->

<body>
  
  <div id="map_canvas" style="width: 100%; height: 600px;"></div>

  <script src="{{ asset('assets/javascripts/shopRoad.js') }}"></script>

  <!-- マップの大きさは各ページで揃える -->

@endsection