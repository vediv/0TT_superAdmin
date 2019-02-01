 function addNewPublisher() {
    var valid;	
    valid = addpublisher();
    if(valid)
    {    
      var datastring = $("#add_publisherForm").serialize();
      $("#msg").html("");
      $.ajax({
              url:"login_core.php",
	      data:datastring+'&loginType=add_publisher',
	      type: "POST",
              success:function(res){
               alert("zdvhasdh");
                 if(res=="1")
                 {
                   $("#msg").css('color','#DD4B39').html("<strong> Partner Id </strong> already exist.?");
                   
                 }
                 if(res=='4')
                 {
                    console.log("yes");
                    $("#msg").css('color','#DD4B39').html("<strong> Email </strong> already exist.?");
                   
                 }
                 if(res=='2')
                 {
                     $("#pname").val(""); $("#inputEmail").val(""); $("#company_name").val("");
                     $("#admin_secret").val(""); $("#partnerid").val(""); $("#service_url").val("");
                     $("#service_url").val(""); $("#inputPassword").val("");
                     //$("#msg").css('color','#DD4B39').html("<strong>Add Publisher!</strong> successfully.");
                     document.getElementById("msg").innerHTML = "<center><img src='img/image_process.gif' height='20'></center>";
                     window.location.href="add_publisher.php";
                 }
                 if(res=='3')
                 {
                     $("#msg").css('color','#DD4B39').html("<strong>Something wrong!</strong> in server please try some time");
                 } 
                 
                 
                 
              },
             error:function (){}
	             });
     }  	         
	 
}
function addpublisher() {
    
	var valid = true;	
	$(".demoInputBox").css('background-color','');
	$(".has-error").html('');
	
        if(!$("#pname").val()) {
		$("#pname-error").css('color','#DD4B39').html("Name required)");
		$("#pname").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#inputEmail").val()) {
		$("#inputEmail-error").css('color','#DD4B39').html("(email ID required)");
		$("#inputEmail").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#inputEmail").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
		$("#inputEmail-error").css('color','#DD4B39').html("(email ID invalid..)");
		$("#inputEmail").css('background-color','#FFFFDF');
		valid = false;
	}
        
         if(!$("#company_name").val()) {
		$("#company_name-error").css('color','#DD4B39').html("Company Name required)");
		$("#company_name").css('background-color','#FFFFDF');
		valid = false;
	}
        if(!$("#admin_secret").val()) {
		$("#admin_secret-error").css('color','#DD4B39').html("Admin Secret required)");
		$("#admin_secret").css('background-color','#FFFFDF');
		valid = false;
	}
      
        
         if(!$("#partnerid").val()) {
		$("#partnerid-error").css('color','#DD4B39').html("Partner ID required)");
		$("#partnerid").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#partnerid").val().match(/^\d+$/)) {
		$("#partnerid-error").css('color','#DD4B39').html("(please enter only number..)");
		$("#partnerid").css('background-color','#FFFFDF');
		valid = false;
	}
        
         if(!$("#service_url").val()) {
		$("#service_url-error").css('color','#DD4B39').html("Service URL required)");
		$("#service_url").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#service_url").val().match(/^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/)) {
		$("#service_url-error").css('color','#DD4B39').html("(please enter Valid Service URL)");
		$("#service_url").css('background-color','#FFFFDF');
		valid = false;
	}
        
	if(!$("#inputPassword").val()) {
		$("#inputPassword-error").css('color','#ff3300').html("(Password required)");
		$("#inputPassword").css('background-color','#FFFFDF');
		valid = false;
	}
	
	return valid;
}