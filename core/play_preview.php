<?php
include_once 'auth.php';
include_once 'core_config.php'; 
$entryID=$_REQUEST['Entryid'];
?>
<script src="<?php echo SERVICEURL;?>/p/<?php echo PARTNER_ID;?>/sp/<?php echo PARTNER_ID;?>00/embedIframeJs/uiconf_id/<?php echo UNICONF_ID; ?>/partner_id/<?php echo PARTNER_ID;?>?autoembed=true&entry_id=<?php echo $entryID; ?>&playerId=<?php echo KALTURA_PLAYER_ID; ?>&width=370&height=220&flashvars[streamerType]=auto"></script>







