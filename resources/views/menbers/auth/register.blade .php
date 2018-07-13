@extends('layout')

@section('content')
<div class="contents row">
    <h2>Sign up</h2>

    {{ Form::open() }}
        <div class="field">
            <label>Nickname <em>(6 characters maximum)</em><label><br>
            <input type='text' name="name" autofocus="autofocus">
        </div>

        <div class="field">
            <label>Email</label>
            <input type="email" name="email">
        </div>

        <div class="field">
            <label>Password</label>
            @if (false)
                <em>(6 characters minimum)</em>
            @endif
            <br />
            <input type="password" name="password" autocomplete="off">
        </div>

        <div class="field">
            <label>password confirmation</label><br>
            <input type="password" name="password_confirmation" autocomplete="off">
        </div>

        <div class="actions">
            <input type="submit" value="Sign up">
        </div>
    {{ Form::close() }}
</div>
@endsection
