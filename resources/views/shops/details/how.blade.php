<select id="example-getting-started" multiple="multiple" style="width=25%;">
  <option value="LINE_Pay">LINE Pay</option>
  <option value="Rakuten_Pay">楽天ペイ</option>
  <option value="Origami">Origami</option>
</select>
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
