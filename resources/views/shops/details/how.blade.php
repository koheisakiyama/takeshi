<!--
<select name="pay" id="example-getting-started" multiple="multiple" style="width=25%;">
  <option value="LINE">LINE Pay</option>
  <option value="rakuten">楽天ペイ</option>
  <option value="origami">Origami</option>
</select>
-->
{{ Form::select('method', ['line'=>'LINE Pay', 'rakuten'=>'楽天ペイ', 'origami'=>'Origami'], null, ['id' => 'example-getting-started','class' => 'form-control', 'multiple'=>'multiple', 'style'=>'width=25%;']) }}
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
