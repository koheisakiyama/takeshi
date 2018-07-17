{{ Form::select('method[]', ['line'=>'LINE Pay', 'rakuten'=>'楽天ペイ', 'origami'=>'Origami'], null, ['id' => 'example-getting-started','class' => 'form-control', 'multiple'=>'multiple', 'style'=>'width:100%;']) }}

<script type="text/javascript">
  $(document).ready(function() {
      $('#example-getting-started').multiselect({
        includeSelectAllOption: true,
        selectAllNumber: false,
        nonSelectedText: '支払い方法',
        selectAllText: '全て選択',
        allSelectedText: '全て選択する'
    });
  });
</script>
