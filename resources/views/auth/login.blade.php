@extends('layout')

@section('content')

<style>

.box-size {
    float: middle;
    margin:0 auto;
}

.clearfix:after {
  content: "";
  clear: both;
  display: block;
}

</style>

<div class="panel panel-default box-size clearfix" style="width: 20%; margin-top: 80px; ">
<div class="panel-body" >
<!-- <div class="container"> -->
<div class="contents row" style="margin-left: 20%;">
    <h2>ログイン</h2>

    {{ Form::open() }}
        <div class="field">
            <label>メールアドレス</label><br>
            <input type="email" name="email" autofocus="autofocus">
        </div>

        <div class="field">
            <label>パスワード</label><br>
            <input type="password" name="password" autocomplete="off">
        </div>

        <div class="actions" style="padding-top: 20px">
            <input type="submit" value="ログイン" href='search'>
        </div>
    {{ Form::close() }}
</div>
</div>
</div>

@endsection
