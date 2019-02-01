<?php
include_once 'include/function.inc.php';
$action=(isset($_POST['action']))? $_POST['action']: "";
switch($action)
{
        case "save_edit_menu":
        $mid=$_POST['mid'];$mname=$_POST['mname'];$menu_url=$_POST['menu_url'];$icon_class=$_POST['icon_class'];    
        $upqry="update menus set mname='$mname',menu_url='$menu_url',icon_class='$icon_class' where mid='".$mid."'";
        $r= db_query($upqry);
        if($r)
        {
        $query1="select  mname,menu_url,icon_class from menus where mid='$mid'";
        $row= db_select($query1);
        echo json_encode(array('success' => 1,'data' =>$row)); 
        }
        break;   
        case "edit_menu":
        ?>
     <div class="modal-body">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  <b>Edit Menu</b>
                </h4>
            </div>
             <br/>
	<div class="tab-content" id="tabs">
	<?php  
        $mid=$_POST['mid'];   
        $query1="select  mname,menu_url,icon_class from menus where mid='$mid'";
        $row= db_select($query1);
        $mname=$row[0]['mname'];	
        $menu_url=$row[0]['menu_url'];	
        $icon_class=$row[0]['icon_class']; 
        ?>
        <div style=" border:1px solid #c7d1dd ;">
        <form class="form-horizontal" role="form" action="javascript:" method="post" id="confirm" onsubmit="return save_edit_menu('<?php echo $mid; ?>')">
                    <div class="form-group" style="margin-top: 12px">
                      <label class="control-label col-sm-4">Menu Name:</label>
                         <div class="col-sm-5">
                             <input type="text" class="form-control" required maxlength="20" name="mname" id="mname" value="<?php echo $mname; ?>"> 
                              <span class="help-block has-error" id="mname-error" style="color:red;"></span>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4">Menu URL:</label>
                         <div class="col-sm-5">
                           <input type="text" class="form-control" maxlength="25" required  name="menu_url" id="menu_url" value="<?php echo $menu_url; ?>">
                              <span class="help-block has-error" id="menu_url-error" style="color:red;"></span>  
                        </div>
                    </div>
              <div class="form-group">
            <label class="col-md-4 control-label">Menu Icon Class:</label>
            <div class="col-md-5">
            <input type="text" class="form-control" maxlength="30" required name="icon_class" id="icon_class" value="<?php echo $icon_class; ?>">
            <span class="help-block has-error" id="icon_class-error" style="color:red;"></span>
            </div>
        </div>
            <div class="modal-footer">
<div class="col-sm-offset-2 col-sm-4">
<button type="submit" name="img_up" class="btn btn-primary" >Update</button>
</div>
</div>
</form>
       </div>
        
        
        </div>			 	       
      </div>   
     <?php 
     break; 
}
?>
