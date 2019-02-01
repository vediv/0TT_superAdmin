<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', TRUE);
$database_name="santosh_103";
$path = "../data/";
            if (!is_dir($path.$database_name)) {
                mkdir($path.$database_name, 0777, true); 
                
                if (!is_dir($path.$database_name."/upload_icon")) {
                 mkdir($path.$database_name."/upload_icon", 0777, true);
                    
                }
                if (!is_dir($path.$database_name."/upload_slider")) {
                 mkdir($path.$database_name."/upload_slider", 0777, true);
                    
                }
                if (!is_dir($path.$database_name."/upload_thumb")) {
                 mkdir($path.$database_name."/upload_thumb", 0777, true);
                    
                }
                // mkdir("$path.$database_name/upload_slider", 0777, true);
                // mkdir("$path.$database_name/upload_thumb", 0777, true);
              
                //}
            }
            
            

?>
