@extends ('layout')

@section ('content')
  <div class="container">
   {{ Form::open(['action' => 'ShopsController@result', 'method' => 'get']) }}
    <div>
      @include ('shops.details.how')
    </div>
    <div>
      @include ('shops.details.what')
    </div>
    <div>
      @include ('shops.details.where')
    </div>
      {{ Form::submit('検索', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
  </div>

@endsection
