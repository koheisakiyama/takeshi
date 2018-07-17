@extends('layout')

@section('content')
<div class="contents row">
    <h2>Log in</h2>

    {{ Form::open() }}
        <div class="field">
            <label>Email</label><br>
            <input type="email" name="email" autofocus="autofocus">
        </div>

        <div class="field">
            <label>Password</label><br>
            <input type="password" name="password" autocomplete="off">
        </div>


        <div class="field">
            <label>Remember me</label><br>
            <input type="checkbox" value="1" name="rememver_me">
        </div>


        <div class="actions">
            <input type="submit" value="Log in">
        </div>
    {{ Form::close() }}
</div>
@endsection
