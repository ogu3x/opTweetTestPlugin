<div id="homeRecentList_<?php echo $gadget->id ?>" class="dparts homeRecentList">
<div class="parts">
<div class="partsHeading"><h3>TweetTest</h3></div>

<div class="block">
<form name="tweetTest_<?php echo $gadget->id ?>_form" id="tweetTest_<?php echo $gadget->id ?>_form" >
<input id="status" name="status" type="text" id="tweetTest_<?php echo $gadget->id ?>_data_body" style="width:250px;" />
<input type="submit" onClick="check('<?php echo url_for("tweet/tweetPost"); ?>');return false;" />
</form>
<textarea id="result" readonly="readonly" cols=32 rows=10 style="width:250px;"></textarea>
</div>

</div>
</div>
<script type="text/javascript">
function check(url)
{
  $('result').value = "";
  var status = document.tweetTest_<?php echo $gadget->id ?>_form.status.value;
  var pars = 'status=' + status;
  var myAjax = new Ajax.Request(
    url, 
    {
      method: 'post', 
      parameters: pars, 
      onComplete: showResponse
    });

  function showResponse(request)
  {
    var item = eval("("+request.responseText+")");
    //$('result').value = request.responseText;
    $('result').value = item.text;
    $('status').value = "";
  }
}
</script>
