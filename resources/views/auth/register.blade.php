
<!-- 会員登録用のファイル -->

<!-- @extends('layout') -->

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

.space {
    padding-bottom: 10px;
}

</style>

<div class="panel panel-default box-size clearfix" style="width: 30%; margin-top: 80px; ">
<div class="panel-body">
<div class="contents row" style="margin-left: 20%;">
    <div class="space">
    <h2>新規登録</h2>

    {{ Form::open() }}
        <div class="field space">
            <label>ニックネームを設定してください</label><br>
            <input type='text' name="name" autofocus="autofocus">
        </div>

        <div class="field space">
            <label>メールアドレスを入力してください</label><br>
            <input type="email" name="email">
        </div>

        <div class="field space">
            <label>パスワードを設定してください<br>
                   （6文字以上）</label>
            @if (false)
                <em>(6 characters minimum)</em>
            @endif
            <br />
            <input type="password" name="password" autocomplete="off">
        </div>

        <div class="field space">
            <label>もう一度パスワードを入力してください</label><br>
            <input type="password" name="password_confirmation" autocomplete="off">
        </div>

        <div class="actions" style="padding-top: 20px">
            <input type="submit" value="新規登録" href='/search'>
        </div>
    {{ Form::close() }}
</div>
@endsection
