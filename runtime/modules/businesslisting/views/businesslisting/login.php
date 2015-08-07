<!--<div class="login_box">
    <div id="terms-conditions" class="u-email-box">
        <div class="my-account-popup-box"> 
		<h4>Please enter your username and password to continue</h4>
		  <form action="#" method="post">
                <input type="text" name="username" placeholder="Username" size="45" /><br>
                <input type="password" name="username" placeholder="Password" size="45" /><br>
                <span class="middle"> 
                    <input type="submit" name="publish" value="Submit" class="button black" />
                </span>
		   </form>
		  <div class="retrieve" style="  float: right;"> <a href="#">Retrieve username and password</a> </div>
        </div>
    </div>
</div> -->
    <div class="login_box">
        <div id="terms-conditions" class="u-email-box">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png " />
            <div class="my-account-popup-box"> 
                    <div id="login1">
            	       <h4>Please enter your username and password to continue</h4>
                    	  <form action="#" method="post" id="login_form" onsubmit="return login_validation(this.form)" />
                             
                              <input onblur="if(this.value=='')this.value='Username'" onfocus="check_user_info(this.id);" type="text" name="drg_username" title="Please enter your username"  value="<?php if(isset($_COOKIE['username'])!=''){ echo $_COOKIE['username']; } else { echo "Username"; } ?>" id="drg_username" size="20"  />
                        	
                                <div id="passwordbox">
                                    <input type="text" id="drg_pass" name="drg_pass" size="20" title="Plase enter your password" onfocus="check_pass_info(this.id);" onblur="check_pass_out(this.id);" value="<?php if(isset($_COOKIE['password'])!=''){ echo $_COOKIE['password']; } else { echo "Password"; } ?>" /> 
                                </div> 
                             <div class="retrieve">
                                 <a class="login_sbmt lpa" href="<?php echo Yii::app()->baseUrl.'?retrieve=password'?>" title='Reset your password'>

                                Retrieve username and password</a>
                             </div>
                             
                    	     <span class="middle"> 
                                <input type="submit" name="publish" value="Continue" class="button black" /> 
                             </span>
                    	   </form>
            	   </div>
                   <!-- lost password area -->	
                    <div id="lost_pass_request" style="display:none">   	
                        <div id="lostpass-box">
                         <h4>Password reset request</h4>                      
                        <form action="#" method="post" onsubmit="return false;">
                            <?php echo CHtml::hiddenField('YII_CSRF_TOKEN',Yii::app()->request->csrfToken); ?>
                            <input onblur="if(this.value=='')this.value='Enter your Email address'" onfocus="if(this.value=='Enter your Email address' || this.value=='Please enter your email' || this.value=='Email address does not exist')this.value=''" onclick="if(this.value=='Enter your Email address')this.value=''" type="text" name="drg_lost_email" id="drg_lost_email" title="Enter your Email address"  value="Enter your Email address" size="20"  />
                            <div class="sign-option">
                                <input class="button black" name="lostpass_sbmt" type="button" value="Submit" onclick="return lost_password1();" />
                            </div> 
                        </form>
                        </div>
                    </div>
                    <!--Reset success -->
                    <div id="reset_success" style="display:none">      
                        <!--lost password form-->
                        <div id="lostpass-box">
                            <h3>Your password reset instructions have been sent to your email address. Please allow a few minutes to receive the email.</h3>
                            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>">Close &#062;&#062; </a>
                        </div> <!-- /lost password area -->		
                    </div>
                    </div> <!-- /lost password area -->	 
            </div>
        </div>
    </div>
    <style type="text/css">
        .login_box{ margin-left:30%; margin-top:10%;}
        .login_box .u-email-box{ width:400px;}
        .login_box .u-email-box .my-account-popup-box{ padding:40px 24px;}
        .login_box .my-account-popup-box h4,#lost_pass_request h4{ font-size:12px; font-weight:normal; padding-bottom:10px;}
        .login_box .my-account-popup-box input[type="text"],
        .login_box .my-account-popup-box input[type="password"]{ width:94.5%; padding:0 2%; height: 26px; line-height:26px; background: #fff; border: 1px solid #000; }
        .login_box #passwordbox {margin-top: 10px;}
        .login_box .my-account-popup-box .login_sbmt{ width:100%; text-align: right; margin-top:5px;}
        .sign-option input[type="button"]{width: 100px !important;} 
    </style>
    
    
<script type="text/javascript">

function show_lost_pass_form1()
{
	$("#login1").hide();
    $("#lost_pass_request").show();		
}
function lost_password1() 
{
	var failedvalidation = false;
    var drg_lost_email = document.getElementById("drg_lost_email").value;
	if(drg_lost_email == "Enter your Email address" || drg_lost_email == "Please enter your email" || drg_lost_email == "")
        {                
            $("#drg_lost_email").css('border','1px solid #f00'); 
			$("#drg_lost_email").val('Please enter your email');            
            failedvalidation = true;            
        } 
	
	if(failedvalidation==false)
	{
		 $.ajax({
             type: "POST",
             url: "<?php echo Yii::app()->createUrl('/site/forget');?>",
			 async: false,
             //data: 'type=lost_password&email='+drg_lost_email,
              data: 'drg_lost_email='+drg_lost_email+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
             success: function(result)
			 {
			     var result1 = jQuery.parseJSON(result);
                  
				 if(result1.success=='true')
				 {  
				     $("#lost_pass_request").css('display','none');
					 $("#reset_success").fadeIn('slow');
					 failedvalidation = false;
                      
				 }				  
				 else
				 {	 
				 	$("#drg_lost_email").css('border','1px solid #f00');
					$("#drg_lost_email").css('color','#f00');
					$("#drg_lost_email").val('Email address does not exist');
				    failedvalidation = true;
            	 }  
				 return false;
        	},
			error: function(a)
			 {
				 alert(a);
			 }
  		});
	}
		
	if(failedvalidation) 
	{
        return false;
    }   
	
}





function login_validation(frm) 
{
	var failedvalidation = false;
    var drf_name = document.getElementById("drg_username").value;
	var drf_pass = document.getElementById("drg_pass").value;
	
    if(drf_name == "Username" || drf_name == "Please enter your username" || drf_name == "")
        {                
            $("#drg_username").css('border','1px solid #f00'); 
			$("#drg_username").val('Please enter your username');            
            failedvalidation = true;            
        }     
   
    if(drf_pass == "Password" || drf_pass == "Please enter your password" || drf_pass=='')
	{                
		$("#drg_pass").css('border','1px solid #f00'); 
		$("#drg_pass").val('Please enter your password');               
		failedvalidation = true;             
	}  
	
	
	if(failedvalidation==false)
	{
	     if($("#rememberme").is(':checked'))
         {    setCookie('username',drf_name);
              setCookie('password',drf_pass); 
                               
         } 
       
		 $.ajax({
             type: "POST",
             url: "<?php echo Yii::app()->createUrl('/login'); ?>",
			 async: false,
             data: 'LoginForm[username]='+drf_name+'&LoginForm[password]='+drf_pass+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
             success: function(data)
			 {
                
                var result = jQuery.parseJSON(data);
                 //alert(result.success);
				 if(result.success=='true')
				 {  
				    window.location.reload();
					failedvalidation = false;
                      
				 } else{
                    
                    if(result=='User name Exist'){				 	
				 	$("#drg_pass").css('border','1px solid #f00');
                    $("#drg_username").css('border','1px solid #999999');
					$('#drg_pass').attr('type', 'text');  
					$("#drg_pass").val('Password not recognized');
				    failedvalidation = true;
            	 }else{
                    $("#drg_username").css('border','1px solid #f00');
                    $("#drg_username").val('Username not recognized');
                    $("#drg_pass").css('border','1px solid #f00');                  
					$('#drg_pass').attr('type', 'text');  
					$("#drg_pass").val('Password not recognized');
				    failedvalidation = true;
                 }
                                 
                }
				 return false;
        	},
			error: function(a)
			 {
				 //alert(a);
			 }
  		});
	}
	
    if(failedvalidation) 
	{
        return false;
    }
}

    
    </script>