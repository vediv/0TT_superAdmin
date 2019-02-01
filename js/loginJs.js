function PopupCenterDual(url, title, w, h) {
// Fixes dual-screen position Most browsers Firefox
var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
var left = ((width / 2) - (w / 2)) + dualScreenLeft;
var top = ((height / 2) - (h / 2)) + dualScreenTop;
var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
// Puts focus on the newWindow
if (window.focus) {
newWindow.focus();
}
}


function sendLogin() {
   var valid;	
    valid = validateContact1();
    if(valid) {
		      var userEmail=$("#email").val();
		      var UserPass=$("#password").val();
		      $.ajax({
			  url: "login_core.php",
		          data:'userEmail='+userEmail+'&UserPass='+UserPass+'&loginType=login',
			  type: "POST",
			  success:function(res){
                              console.log(res);
			       if(res=="1")
                               {
                                 window.location.href="dashbordm.php";
                               }
                               if(res=='2')
                               {
                                   $("#msg").css('color','#DD4B39').html("(Email and password Not matched.)");
                               }    
                               
			   },
			   error:function (){}
	             });   
		         
	     }
}
 
          
function validateContact1() {
	
	$(".demoInputBox").css('background-color','');
	$(".has-error").html('');
	
	if($("#email").val()=='') {
		$("#email-error").css('color','#DD4B39').html("Email ID required..");
		$("#email").css('background-color','#FFFFDF');
		return false;
	}
	if(!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
		$("#email-error").css('color','#DD4B39').html("Please Enter valid Email ID..");
		$("#email").css('background-color','#FFFFDF');
		return false;
	}
	if($("#password").val()=='') {
		$("#password-error").css('color','#ff3300').html("Password required..");
		$("#password").css('background-color','#FFFFDF');
		return false;
	}
	
	return true;
}

