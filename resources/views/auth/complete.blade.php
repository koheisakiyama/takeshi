@extends('layout')

@section('content')
<div class="contents row" style="margin-left: 10%;">
    <h2>登録が完了しました</h2>

    {{ Form::open() }}
        <div class="field">
            <p>登録が完了しました

        </div>
    {{ Form::close() }}
</div>
@endsection
