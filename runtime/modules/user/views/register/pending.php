<div class="clear"></div> 

 <?php $this->breadcrumbs = array('Active'); ?> 
 
 <?php //$this->renderPartial('//layouts/breadcrumbs') ?>
 
 <div class="registration-box">    

 <div class="close_caform">       

 <a class="button white smallrounded" href="<?php echo Yii::app()->baseUrl; ?>" title="Close" >X</a>  

 </div>     

 <div id="registration-tabs"><a href="#taba">Create Account</a>    

 <div class="clear"></div>    

 </div>        

 <div class="registration-content">   

 <div class="pop-up" style="width:546px;">      

 <div id="robby-popup" style="top:-33px;">     

 <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/pink-robot-2.png" alt="Robot giving thumbs up" height="170" width="236" />      

 </div>           

 <div class="pop-up-content">        

 <h1 align="center">Sign up successful</h1>       

 <br />                   

 <p style="color: #A84793;"> Thank you for signing up.<br />    

 An activation link has been sent to your email address</p>    

 <br />                       

 <p style="color: #808080;"><em><strong>Didn't get the email?</strong> Please check your Spam/Junk email folder.<br />   

 Your activation email may take up to 3 minutes to arrive depending on internet traffic.<br />     

 If you still haven't received the email you may                      
    <strong>
        <a href="<?php echo Yii::app()->createUrl('/user/register/resendactive',array("code"=>$model->user_default_activate_link));?>">Click here >></a>   
    </strong>
 to re-send the activation link.</em></p>     

 <br />                  

 <br />               

 <p><a class="button black" href="<?php echo $this->createAbsoluteUrl('/'); ?>">Close</a></p>      

 <br />      

 </div>          

 </div>             

 <div class="clear"></div>  

 </div>      

 </div> 
 
 
 
 