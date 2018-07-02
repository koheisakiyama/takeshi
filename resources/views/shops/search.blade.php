@extends ('layout')

@section ('content')
  <div class="container">
   {{ Form::open(['action' => 'ShopsController@result', 'method' => 'post']) }}
      {{ Form::select('method', ['line'=>'LINE Pay', 'rakuten'=>'楽天ペイ', 'origami'=>'Origami'], null, ['id' => 'example-getting-started','class' => 'form-control', 'multiple'=>'multiple', 'style'=>'width=25%;']) }}
      {{ Form::select('category', ['レストラン', 'コンビニ', 'ビューティー', '雑貨'], null, ['class' => 'form-control', 'style'=>'width=25%;']) }}
      {{ Form::select('area', ['新宿', '渋谷', '品川'], null, ['class' => 'form-control','style'=>'width=25%;']) }}
      {{ Form::submit('検索', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect({
          includeSelectAllOption: true,
          selectAllNumber: false,
          nonSelectedText: '支払い方法の選択',
          selectAllText: '全て選択',
          allSelectedText: '全て選択する'
      });
    });
  </script>

@endsection
