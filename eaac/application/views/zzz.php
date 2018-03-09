<!DOCTYPE html>
<html>
<head>
<title>Ajax Example</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
<fieldset style="width: 350px;">
<legend>Name</legend>
<form>
    <h2>Fill the Name</h2>
    Full Name: <input type="text" name="myname" id="myname">
    <input type="button" data-loading-text=" ... " name="clickme" id="clickme" value="Click">
    <br/>
    <div class="row-fluid" id="contentzzz"></div>
</form>
</fieldset>



<script type="text/javascript">
   $(document).ready(function(){
    $('#clickme').click(function(){
      var fname = $('#myname').val();
      var btn = $(this);
      btn.button('loading');
        $.ajax({
          type:'POST',
         data:{jancuk: fname},
         url:'<?php echo base_url('welcome/full_name'); ?>',
         success: function(result){
         $('#contentzzz').html(result);
         $('#clickme').button('reset');
       }
   });
  });
 });
</script>

</body>
</html>