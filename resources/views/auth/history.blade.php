@extends('layout')

@section('content')
<div class="contents row" style="margin-left: 10%;">
    <h2>{{ Auth::user()->name}}さんの閲覧履歴</h2>

    {{ Form::open() }}
    

    {{ Form::close() }}
</div>
@endsection
