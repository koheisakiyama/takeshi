@extends('layout')

@section('content')
<div class="contents row" style="margin-left: 10%;">
    <h2>{{ $name}}さんの閲覧履歴</h2>
    <!-- {{ Form::open() }} -->
    <ul class="list-group search-result-list" style="margin-bottom:0px;">
        @foreach ($history as $histories)
          <li class="list-group-item search-result-item" style="background-color: #F0F0F0">
            <p style="float: left; font-size: 18px; font-weight: bold; color: #4169E1">{{ $histories->shop->name }}</p>
            <p style="float: left; font-size: 18px; margin-right: 15px;"></p>
            <p style="float: left; font-size: 16px;">{{ $histories->shop->address }}</p>
            <p style="float: left; font-size: 18px; margin-right: 15px; margin-left: 15px;">/</p>
            <p style="float: left; font-size: 16px;">{{ $histories->shop->time }}</p>
            <p style="font-size: 18px; margin-left: 15px; color: #F0F0F0">/</p>
          @if ( $histories->shop->link == "なし")
            <p>URLないです</p>
          @else
            <a href="{{ $histories->shop->link }}" style="font-size: 17px; color: #6495ED">店舗情報</a>
          @endif
            <a href="/navi/{{ $histories->shop->id }}" style="font-size: 17px; color: #6495ED">ナビの開始</a>
          </li>
        @endforeach
      </ul>

    <!-- {{ Form::close() }} -->
</div>
@endsection
