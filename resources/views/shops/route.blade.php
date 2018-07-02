<!-- 出発点・検索に入力された値、目的地・選ばれた店情報の所在地　でルートを表示するviewファイル。  seina2018.6.27-->
@extends('layout')
@section('content')
  <!-- ルート表示.  seina　--> 
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ルート探索</title>

<script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('Google_API_Key') }}"></script>

<script src="{{ asset('assets/javascripts/shopRoute.js') }}"></script>

<!--  -->
</head>
<body>

  <div id="map_canvas" style="width: 100%; height: 600px;"></div>
  <!-- マップの大きさは各ページで揃える -->

@endsection