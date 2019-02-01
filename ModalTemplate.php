<?php 

?>
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 14px; ">
        <div class="modal-body">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  <b>Create Menu</b>
                </h4>
            </div>
       <br/>
	<!-- <form class="form-horizontal" role="form" action="#" method="post" id="confirm" style="border: 0px solid red;">-->
		  <div style="border: 1px solid #c7d1dd ; padding-top: 20px ">
<form id="myform" method="post" class="form-horizontal" >
<div class="col-lg-12">
  <div class="form-inline">
  <div class="col-sm-6 col-md-6 col-lg-6 pull-right">
 <!-- <input type="text" class="form-control" name="category_search" style="  width: 271px !important; margin-left: 9em;"   value="" placeholder="Search Categories">-->
  </div>
  </div>
</div>       
<hr style="border-top:2px solid red; margin-top: 0px; padding: 0px 0px 0px 0px">  </hr>
<div class="form-group" >
<label for="inputPassword" class="control-label col-xs-4">Menu Category:</label>
<div class="col-xs-8">
<div class="container1"> 	                 
<div class="row"> 
<div class="col-md-12" style="padding-right: 20px">
<div id="sidebar" class="well sidebar-nav" style="border: 0px solid red;"> 
<div class="mainNav">
 <div style="margin: 0px 0 9px 0px !important">
     <input type="radio" name="menu_value"  id="menu_value" required value="0" style="margin: 3px 23px 10px 6px  !important"> No Parent </label>
 </div>
<ul style="height:170px;overflow-y: scroll;display: block;   border: 1px solid #c7d1dd; padding: 10px 2px;">
<?php
$que="SELECT mid,mname,mparentid FROM menus where mparentid=0" ;
$row=db_select($que);
foreach ($row as  $menu) {                                    
$mid=$menu['mid']; $mname=$menu['mname'];  $mparentid=$menu['mparentid']; $icon=$menu['icon'];
?>    
<li style="border-bottom: 1px solid #c7d1dd !important; border-top: 0px solid #c7d1dd !important;"> <input type="radio" name="menu_value"    id="menu_value" required value="<?php  echo $mid; ?>">	
<a href="#" style="font-size: 13px !important; color: #555;"><?php echo strtoupper($mname);?></a>
<ul>
<?php
 $ques="SELECT mid,mname FROM menus where mparentid='$mid'" ;
$rows=db_select($ques);
foreach ($rows as  $menus) {                                    
$mids=$menus['mid'];  $mnames=$menus['mname'];

   ?>	
<li>
<a href="#"> <?php  echo strtoupper($mnames); ?></a>

</li>
<?php } ?>
</ul>
</li>			
<?php 
  }
 ?>
</ul>
</div>
  </div>
        </div>    
    </div>                                                                                                           
</div> 
  </div>
     </div>

       <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-4">Menu Name:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control" required id="m_name" name="m_name" placeholder="Menu Name" value="">
            </div>
        </div>
         <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-4">Menu URL:</label>
            <div class="col-xs-7">
            <textarea class="form-control" rows="1" id="m_url" name="m_url" placeholder="Page URL" ></textarea>
            </div> 
        </div>
         <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-4">Menu Icon Class:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control" required id="icon" name="icon" placeholder="Menu Icon Class" value="">
            </div>
        </div>
       
<div class="form-group">
    <div class="col-xs-offset-4 col-xs-8">
        <button type="submit" class="btn btn-primary btn-primary1" name="save_menu">Save & Close</button>
    </div>
 </div>

   </form> </div> </div>
		
  </div>
    </div>
  </div>       

