<?php
include_once 'auth.php';  
include_once '../include/connect_db.php';
//if(isset($_GET['id']))
	
  $id=$_REQUEST['id'];

 
$query1="select sid,body_color,font_color,font_size from setting where sid='$id'";
$r= $mysqli->query($query1);
$query2=mysqli_fetch_array($r);

?>
    
      <!-- Modal content-->
   <html>
   
    <script type="text/javascript" src=""></script>
  <body>
  	 
<div class="tab-pane active" id="tab1" >
  	 
     <form class="form-horizontal" role="form" action="#" method="post" ><br/>
						<div class="form-group">
						<label class="control-label col-md-3">Font size</label>
						<div class="col-sm-7">										
		                <select class="form-control" name="confirmm" style="width:300px" >
                     	<option  class="form-control"><?php echo $query2['font_size']; ?></option>
                     	<option value-=''>Select Font size</option>
                        <option value-='8'>8px</option>
                        <option value-='9'>9px</option>
                        <option value-='10'>10px</option>
                        <option value-='11'>11px</option>
                        <option value-='12'>12px</option>
                        <option value-='14'>14px</option>
                        <option value-='16'>16px</option>
                        <option value-='18'>18px</option>
                        <option value-='20'>20px</option>
                        <option value-='24'>24px</option>
                        <option value-='28'>28px</option>
                        <option value-='36'>36px</option>
                        <option value-='48'>48px</option>                       
                      </select>													     
						</div>
										</div>
								<br/>
									   <div class="form-group"> <br/>
									       <label class="control-label col-md-3" >Body Color</label>
									      <div class="col-sm-7"> 
									        <input type="text" style="width:300px"  id="hue-demo"  name="bcolor" class="form-control demo" data-control="hue" value="<?php echo $query2['body_color']; ?>" required/>
									      </div>	
									    </div>
								
									<br/>
									   <div class="form-group"> <br/>
									      <label class="control-label col-md-3" >Font Color</label>
									      <div class="col-sm-7"> 
									        <input type="text" style="width:300px" id="saturation-demo" name="fcolor" class="form-control demo" data-control="saturation" value="<?php echo $query2['font_color']; ?>" required
									        >
									      </div>	
									    </div>   
									   
				          <input type="hidden" class="form-control" name="id" value="<?php echo $query2['sid']; ?>">
									  
									   <div class="modal-footer" style="margin-top:25px;">
									           <div class="col-sm-offset-2 col-sm-5">
									    <button type="submit" name="sub" class="btn btn-primary" id="edit">Update</button>
									   </div>
									  </div>

						  </form>
   </div>
     
    <script type="text/javascript">
$(function(){
  var colpick = $('.demo').each( function() {
    $(this).minicolors({
      control: $(this).attr('data-control') || 'hue',
      inline: $(this).attr('data-inline') === 'true',
      letterCase: 'lowercase',
      opacity: false,
      change: function(hex, opacity) {
        if(!hex) return;
        if(opacity) hex += ', ' + opacity;
        try {
          console.log(hex);
        } catch(e) {}
        $(this).select();
      },
      theme: 'bootstrap'
    });
  });
  
  var $inlinehex = $('#inlinecolorhex h3 small');
  $('#inlinecolors').minicolors({
    inline: true,
    theme: 'bootstrap',
    change: function(hex) {
      if(!hex) return;
      $inlinehex.html(hex);
    }
  });
});
</script> 
  
</body>
</html>
  


