<?php
include_once("../config.php");
 $filter->orderBy = "-createdAt";
$filter = null;
$pager = null;
$pager = new KalturaFilterPager();
						 $pager->pageSize = 7;
						 $pager->pageIndex =1;
$result = $client->baseEntry->listAction($filter, $pager);
print '<pre>'.print_r($result, true).'</pre>';


/*$filter = null;
$pager = new KalturaFilterPager();
$pager->pageSize = 7;
$pager->pageIndex = 1;
$result = $client->liveStream->listAction($filter, $pager);
print '<pre>'.print_r($result, true).'</pre>';
*/

//$filter->entryIdEqual = $EntryID;
//$filter = new KalturaAssetFilter();

//$filter->entryIdEqual = '0_vjcvdehu';
//$pager = new KalturaFilterPager();
//$pager->pageSize = 5;
//$pager->pageIndex =1;
//$result_media = $client->thumbAsset->listAction($filter, $pager);
//$total_pages=$result_media->totalCount;
//print '<pre>'.print_r($result_media, true).'</pre>';



 exit;
 ?>

<!DOCTYPE html>
	<head>
	<title>jQuery enable/disable button</title>
	<script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>
	<script type='text/javascript'>
	$(function(){
	     $('#searchInput').keyup(function(){
	          if ($(this).val() == '') { //Check to see if there is any text entered
	               //If there is no text within the input ten disable the button
	               $('.enableOnInput').prop('disabled', true);
	          } else {
	               //If there is text in the input, then enable the button
	               $('.enableOnInput').prop('disabled', false);
	          }
	     });
	});
	</script>
	<style type='text/css'>
	     /* Lets use a Google Web Font :) */
	     @import url(http://fonts.googleapis.com/css?family=Finger+Paint);
	     /* Basic CSS for positioning etc */
	     body {
	          font-family: 'Finger Paint', cursive;
	          background-image: url('bg.jpg');
	     }
	     #frame {
	          width: 700px;
	          margin: auto;
	          margin-top: 125px;
	          border: solid 1px #CCC;
	          /* SOME CSS3 DIV SHADOW */
	          -webkit-box-shadow: 0px 0px 10px #CCC;
	         -moz-box-shadow: 0px 0px 10px #CCC;
	         box-shadow: 0px 0px 10px #CCC;
	         /* CSS3 ROUNDED CORNERS */
	         -moz-border-radius: 5px;
	         -webkit-border-radius: 5px;
	         -khtml-border-radius: 5px;
	         border-radius: 5px;
	         background-color: #FFF;
	     }
	     #searchInput {
	          height: 30px;
	          line-height: 30px;
	          padding: 3px;
	          width: 300px;
	     }
	     #submitBtn {
	          height: 40px;
	          line-height: 40px;
	          width: 120px;
	          text-align: center;
	     }
	     #frame h1 {
	          text-align: center;
	     }
	     #frame form {
	          text-align: center;
	          margin-bottom: 30px;
	     }
	</style>
	</head>
	<body>
	     <div id='frame'>
	          <div class='search'>
	               <h1>jQuery Enable and Disable button</h1>
	               <form method='post'>
	                    <input type='text' name='searchQuery' id='searchInput' /> 
	                  <!--  <input type='button' value="yes" name='submit' id='submitBtn' class='enableOnInput' disabled='disabled' />-->
	                    <button class="enableOnInput btn btn-default" disabled='disabled' id='submitBtn' type="button" >Yes</button>
	               </form>
	          </div>
	     </div>
	</body>
	</html>
	

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Large Modal</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Large Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>This is a large modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="http://ott01.planetcast.co.in/p/101/sp/10100/embedIframeJs/uiconf_id/23448371/partner_id/101?autoembed=true&entry_id=0_mgtm70dj&playerId=kaltura_player_1465278071&cache_st=1465278071&width=400&height=333&flashvars[streamerType]=auto"></script>
</body>
</html>


