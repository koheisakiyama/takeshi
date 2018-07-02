@extends ('layout')

@section ('content')
  <div class="container">
    {{ Form::open(['url' => '/tweets', 'method' => 'post']) }}
      @include ('shops.details.how')
      @include ('shops.details.what')
      @include ('shops.details.where')
    {{ Form::close() }}
  </div>

@endsection
