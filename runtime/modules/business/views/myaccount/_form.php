<style type="text/css">
#ui-datepicker-div{
left: 255px !important;
    top: 780px !important;
    width: 18.5em !important;
}

@media screen and (-webkit-min-device-pixel-ratio:0) {    
#ui-datepicker-div{
left: 255px !important;
    top: 780px !important;
    width: 18.5em !important;
} 
}
</style>

<div class="clear"></div>

<div class="registration-box">
    
    <div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
        <div class="clear"></div>
    </div>
    
    <div class="registration-content" style="min-height:580px"> 
        <div class="my-account-links">
          <?php 
          $this->renderPartial("//layouts/my-account-links");          
          ?>
        </div>
        <div class="my-account-left">
        
        <!--- update profile picture pop up---->
        <div class="photo-upload-box">
          <img class="side-robot-upload" src="<?php echo Yii::app()->theme->baseUrl;?>/images/robot/robot-upload.png" alt="Upload your dragonsnet user profile picture"/>
          <div class="my-account-popup-box" id="upload-frame"> <a class="pu-close" onclick="hide_picture_form();" href="javaScript:void(0)" title="Close">X</a>
            <h2>Upload your profile picture</h2>
            Click <b>Upload Picture...</b> to choose an image from your computer<br />
            Select an image that is 120px by 120px for best fit <br />
            Your image will be automatically uploaded.<br />
            <br />
            <div id="wrap">    
                <div id="uploader">
                    <div id="big_uploader">
                        <div id="notice"><img src="ajax-loader.gif" /></div>
                        <i>Upload image maximum of 2MB.</i><br /><br />
                        <div id="div_upload_big" class="listing_logo">          
                            <p style="padding: 23px 10px;">Image dimensions <br> must not exceed a standard 6 x 4 photo<br> (400 x 600 pixels max)</p>
                        </div>
                        <div id="div_upload_big_new"></div>
                        <br />
                        Browse for a picture on your computer
                        <br /><br /><br />
                        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                            array(
                                    'id'=>'uploadFile',
                                    'config'=>array(
                                           'action'=>Yii::app()->createUrl('/business/myaccount/uploadprofileimage'),
                                           'allowedExtensions'=>array("jpg",'png','gif'),//array("jpg","jpeg","gif","exe","mov" and etc...
                                           'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                           'minSizeLimit'=>10,// minimum file size in bytes 
                                           'onComplete'=>"js:function(id, fileName, responseJSON){getUploadfilename(responseJSON);}",                                                  
                                    )
                            )); 
                        ?>
                    </div><!-- big_uploader --> 
                </div><!-- uploader --> 
            </div>            
          </div>
        </div>
        
       <!--- update profile picture pop up---->
       <!--- Update your company slogon pop up---->        
        <div class="slogan" style="display: none;">
          <div class="u-email-box slogan-box"> 
            <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png" style="z-index:999999; position:relative; top:-1px;" />
            <div class="my-account-popup-box" style="margin-top:-38px !important"> 
              <a title="Close" href="javaScript:void(0)" onclick="close_slogan_form()" class="pu-close">X</a>
              <br />
              <h2 class="Blue">Update your company slogon </h2> 
              <div id="user_default_business_slogan_error" class="error_msg"></div>
              <table id="reg-table" style="width:100%;">
                <tr> 
                    <td class="darkGrey-text">
                        <input class="inputfield" value="<?php echo $model->user_default_business_slogon; ?>" type="text" name="user_default_business_slogon" id="user_default_business_slogon"  style="width: 370px;"/>                        
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;background: none;border: none; padding-top: 20px;"> 
                        <input id="UpdateSloganBtn" class="button black"  name="register" type="button" value="Update" />
                    </td>               
                </tr>
              </table>
            </div>
          </div>
        </div>
       
        <!-- Update your company slogon popup-->  
        <!--- Update Email Id---->
        <div class="update-email-box">
              <div id="terms-conditions" class="u-email-box"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" />
                <div class="my-account-popup-box"> 
                    <a title="Close" href="javaScript:void(0)" onclick="close_email_form()" class="pu-close">X</a>
                  <h2>Update email address</h2>
                  <div id="email_error" class="error_msg"></div>
                  <form method="post" onsubmit="return email_form_validation()">
                    <table id="reg-table" style="width:100%;">
                      <tr>
                        <th colspan="2">&nbsp;</th>
                        <th class="darkGrey-text"><span class="mandatory-field">*</span> All fields are required</th>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td>Old email address</td>
                        <td><input class="inputfield" type="text" name="user_default_business_email" id="drf_email" onblur="check_old_email(this.value);"/></td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td>New email address</td>
                        <td><input class="inputfield" id="drf_nemail" name="user_default_business_nemail"  type="text" onblur="validateEmail('drf_nemail');" /></td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td>Confirm email</td>
                        <td><input class="inputfield" type="text" name="user_default_business_cemail" id="drf_cemail" onblur="validateEmail('drf_cemail');"/></td>
                      </tr>
                    </table>
                    <br />
                    <span>
                        <input name="email_edit" value="Update email" type="button" onclick="return email_form_validation()" class="button black"  />
                    </span>
                  </form>
                </div>
              </div>
            </div>

        <!---Update Password---->
        <div class="update-password-box">
            <div id="terms-conditions" class="u-email-box"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" />
                <div class="my-account-popup-box"> <a title="Close" href="javaScript:void(0)" onclick="close_password_form()" class="pu-close">X</a>
                  <h2>Update Password</h2>
                  <div id="password_error" class="error_msg"></div>
                  <form method="post" onsubmit="return password_form_validation()">
                    <table id="reg-table" style="width:100%;">
                      <tr class="up-th">
                        <th>&nbsp;</th>
                        <th><span class="mandatory-field">*</span> All fields are required</th>
                        <th>password is case sensitive</th>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td>Old password</td>
                        <td><input class="inputfield" type="password" name="user_default_business_opass" id="drf_opass" onblur="check_old_pwd(this.value);" /></td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td>New password</td>
                        <td><input class="inputfield" id="drf_npass" name="user_default_business_npass" type="password"  /></td>
                      </tr>
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td>Confirm password</td>
                        <td><input class="inputfield" type="password" name="user_default_business_cpass" id="drf_cpass" /></td>
                      </tr>
                    </table>
                    <br />
                    <span>
                        <input name="password_edit" value="Update password" type="button" onclick="password_form_validation()" class="button black"  />
                    </span>
                  </form>
                </div>
            </div>
        </div>
        <div class="pmsg" style="height: 630px; "></div>
        <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'myaccount-form',
                'enableAjaxValidation'=>false,
                'htmlOptions'=>array('enctype'=>'multipart/form-data','onsubmit'=>'return bussinesscheckdod();'),
            ));   
            ?>

        <div class="update-currency-box">
              <div id="terms-conditions" class="u-email-box"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" />
                <div class="my-account-popup-box"> 
                    <a title="Close" href="javaScript:void(0)" onclick="close_currency_form()" class="pu-close">X</a>           
                  <h2>Update Your Currency</h2>
                  <div id="currency_error" class="error_msg"></div>
                    <table id="reg-table" style="margin-left: 40px;">
                      <tr>
                        <td class="mandatory-field">*</td>
                        <td><?php echo $form->labelEx($model,'user_default_business_currency', array('class'=>'field')); ?></td>
                        <td>
                            <?php $cur = CHtml::listData(Currency::model()->findAll(),'currency_id', 'currency_name');?>
                            <?php echo $form->dropDownList($model,'user_default_business_currency',$cur, array('prompt' => 'Please Select','class'=>'chzn-select')); ?>
                        </td>
                      </tr>
                     </table>
                    <br />
                    <span>
                        <input name="email_edit" value="Update Currency" type="button" onclick="return currency_form_validation()" class="button black"  />
                    </span> 
                </div>
              </div>
            </div>  
            <span class="darkMauve-text">&nbsp; Profile details</span>
            <table id="update-table">
                <tr>
                    <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_sector'); ?></td>
                    <td>
                         <?php echo ListingProfession::model()->findByPk($model->user_default_business_sector)->list_profession_name; ?>
                    </td>
                    <?php echo $form->error($model,'user_default_business_sector'); ?>
                </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_name'); ?></td>
                <td width="223"><?php echo $model->user_default_business_name;//$form->textField($model,'user_default_business_name',array('size'=>50,'maxlength'=>50,'class'=>'inputfield')); ?></td>
                <?php echo $form->error($model,'user_default_business_name'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_slogon'); ?></td>
                <td class="editable"><?php echo $form->textField($model,'user_default_business_slogon',array('size'=>50,'maxlength'=>50,'disabled'=>true)); ?></td>
                <td class="edit-link"><a href="javaScript:void(0)" onClick="show_slogan_form()">Edit</a></td>
                <?php echo $form->error($model,'user_default_business_slogon'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_first_name'); ?></td>
                <td><?php echo $model->user_default_business_first_name;//$form->textField($model,'user_default_business_first_name',array('size'=>50,'maxlength'=>50,'class'=>'inputfield')); ?></td>
                <?php echo $form->error($model,'user_default_business_first_name'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_surname'); ?></td>
                <td><?php echo $model->user_default_business_surname;//$form->textField($model,'user_default_business_surname',array('size'=>50,'maxlength'=>50)); ?></td>
                <?php echo $form->error($model,'user_default_business_surname'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_title'); ?></td>
                <td>        
                    <?php echo $model->user_default_business_title; ?>
                </td>
            </tr> 
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_email'); ?></td>
                <td class="editable"><?php echo $form->textField($model,'user_default_business_email',array('size'=>50,'maxlength'=>50,'disabled'=>true)); ?></td>
                <td class="edit-link"><a href="javaScript:void(0)" onClick="show_email_form()">Edit</a></td>
                <?php echo $form->error($model,'user_default_business_email'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_username'); ?></td>
                <td><?php echo $model->user_default_business_username; ?></td>
                <?php echo $form->error($model,'user_default_business_username'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_pass'); ?></td>
                <td class="editable">****************</td>
                <td class="edit-link"><a href="javaScript:void(0)" onClick="show_password_form();">Edit</a></td>                
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_currency'); ?></td>         
                <td class="currency editable"> 
                    <?php $currency =  Currency::model()->findByPk($model->user_default_business_currency); ?>
                    <?php 
                     echo $currency->currency_name;
                    ?>
                </td>
                <td class="edit-link"><a href="javaScript:void(0)" onClick="show_currency_form()">Edit</a></td>
                <?php echo $form->error($model,'user_default_business_currency'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_dob'); ?></td>                
                 <td>
                  <?php echo date('d/m/Y',strtotime($model->user_default_business_dob));?>
                </td>
                <?php echo $form->error($model,'user_default_business_dob'); ?>
            </tr>
			<?php
			$Businessaddress = Businessaddress::model()->findByAttributes(array("user_default_business_id"=>$model->user_default_business_id));     
			?>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($Businessaddress,'user_default_business_addr1'); ?></td>
                <td><?php echo $Businessaddress->user_default_business_addr1;//$form->textField($Businessaddress,'user_default_business_addr1',array('size'=>60,'maxlength'=>500)); ?></td>
                <?php echo $form->error($Businessaddress,'user_default_business_addr1'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($Businessaddress,'user_default_business_addr2'); ?></td>
                <td><?php echo $Businessaddress->user_default_business_addr2;//echo $form->textField($Businessaddress,'user_default_business_addr2',array('size'=>60,'maxlength'=>500)); ?></td>
                <?php echo $form->error($Businessaddress,'user_default_business_addr2'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($Businessaddress,'user_default_business_addr3'); ?></td>
                <td><?php echo $Businessaddress->user_default_business_addr3;//$form->textField($Businessaddress,'user_default_business_addr3',array('size'=>60,'maxlength'=>500)); ?></td>
                <?php echo $form->error($Businessaddress,'user_default_business_addr3'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($Businessaddress,'user_default_business_town'); ?></td>
                <td><?php echo $Businessaddress->user_default_business_town;//$form->textField($Businessaddress,'user_default_business_town',array('size'=>60,'maxlength'=>100)); ?></td>
                <?php echo $form->error($Businessaddress,'user_default_business_town'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($Businessaddress,'user_default_business_county'); ?></td>
                <td><?php echo $Businessaddress->user_default_business_county;?></td> 
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($Businessaddress,'user_default_business_zip'); ?></td>
                <td><?php echo $Businessaddress->user_default_business_zip;//$form->textField($Businessaddress,'user_default_business_zip',array('size'=>50,'maxlength'=>50)); ?></td>
                <?php echo $form->error($Businessaddress,'user_default_business_zip'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($Businessaddress,'user_default_business_country'); ?></td>
                <td>
                   <?php echo Country::model()->findByPk($Businessaddress->user_default_business_country)->user_default_country_name;?>                
                </td> 
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_phone'); ?></td>
                <td><?php echo $model->user_default_business_phone;//$form->textField($model,'user_default_business_phone',array('size'=>30,'maxlength'=>30)); ?></td>
                <?php echo $form->error($model,'user_default_business_phone'); ?>
            </tr>
            <tr>
                <td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_business_website'); ?></td>
                <td><?php echo $model->user_default_business_website;//$form->textField($model,'user_default_business_website',array('size'=>30,'maxlength'=>30)); ?></td>
                <?php echo $form->error($model,'user_default_business_website'); ?>
            </tr>
        </table> 
        </div>
        <div class="my-account-right" style="width:262px;">
          <table id="reg-table2">
            <tr>
              <td class="darkGrey-text"><p style="margin:0 0 0 12px;">Company Logo</p></td>
            </tr>
            <tr>
              <td class="Boarder" id="showImg">
              <?php 
                if($model->user_default_business_image && file_exists(Yii::app()->basePath.'/../www/upload/logo/'.$model->user_default_business_image)){
                    $img = $model->user_default_business_image;            
                    $alt_img = $model->user_default_business_first_name.' '.$model->user_default_business_surname;
                }else {
                    $img = 'avatar.jpg';
                    $alt_img = 'Company logo';
                }
                ?>
                     <img src="<?php echo $this->createUrl('/upload/logo/'.$img);?>" alt="<?php echo $alt_img;?>" height="118" />             
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
                <a href="javaScript:void(0)" title="Change Profile Picture" class="button black" onclick="show_picture_form();"><?php echo $model->user_default_business_image ? 'Update Company Logo': 'Upload Company Logo';?></a>
                <input type="hidden" name="oldimage" id="oldimage" value="<?php echo $model->user_default_business_image; ?>" />
                </td>
            </tr>
            <tr>
              <td>
                <br />
                <div id="terms-conditions" style="width:230px;"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" width="150"  style="margin-bottom:-25px;" />
                     <div>
                    <p> <a href="javascript:void(0);"><b class="in-box Blue">Account overview</b></a>
                        <br />                        
                        <span class="floatLeft">Member Since:</span>
                        <span class="floatRight"> <?php echo $model->user_default_business_rdate; ?></span>
                        <br />
                        <span class="floatLeft">Page visits:</span>
                        <span class="floatRight"> 0</span>
                        <br />
                        <span class="floatLeft">Average user rating:</span>
                        <span class="floatRight golden">*****</span>
                        <br />
                        <span class="floatLeft">Banner advert submission:</span>
                        <span class="floatRight"> 0</span>
                        <br />
                        <span class="floatLeft">Banner advert clicks:</span>
                        <span class="floatRight"> 0</span>
                        <br />
                        <span class="floatLeft">Sample submissions:</span>
                        <span class="floatRight"> 0</span>
                        <br />
                        <span class="floatLeft">Sample feedback received:</span>
                        <span class="floatRight"> 0</span>
                        <br />                        
                        <span class="floatLeft">User downloads:</span>
                        <span class="floatRight"> 0</span>
                        <br />
                        <span class="floatLeft">User favourites:</span>
                        <span class="floatRight"> 0</span>
                        <br />
                        <span class="floatLeft">Reputation:</span>
                        <span class="floatRight"> 0</span>
                        <br />
                    </p>
                    </div>
                </div>
              </td>
            </tr>
          </table>
        </div>
        <div class="clear"></div>
 <?php $this->endWidget(); ?>
</div> 
</div>

<script type="text/javascript">

$(".chzn-select").chosen();

function getUploadfilename(result){
    if(result.success){ 
        jQuery("#showImg").html('');
        var img = '<img src="<?php echo Yii::app()->baseUrl.'/upload/logo/'; ?>' + result.filename + '" height="118" />'
        jQuery("#oldimage").val(result.filename);
        jQuery("#showImg").html(img);
        jQuery(".my-account-links,#update-table,.fBtn").css({
          'opacity': 1,
          '-ms-filter':"",
          'filter': ''
        });
        jQuery(".photo-upload-box").hide();
   }
 }

function show_currency_form(){
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 0,
      '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
      'filter': 'alpha(opacity=0)'
    });
    $(".update-currency-box").show();
}

function close_currency_form(){
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 1,
      '-ms-filter':"",
      'filter': ''
    });
    $(".update-currency-box").hide();
}

// show email form
function show_email_form()
{
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 0,
      '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
      'filter': 'alpha(opacity=0)'
    });
    $(".update-email-box").fadeIn();
}

/* Slogan */  
function show_slogan_form(){
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 0,
      '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
      'filter': 'alpha(opacity=0)'
    });
    $(".slogan").show();
}

function close_slogan_form(){
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 1,
      '-ms-filter':"",
      'filter': ''
    });
    $(".slogan").hide();
}

/* Slogan */  
function close_email_form(){
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 1,
      '-ms-filter':"",
      'filter': ''
    });
    $(".update-email-box").fadeOut();
    $("#email_error").html('');
    $("#drf_email,#drf_nemail,#drf_cemail").val('');
}

function show_password_form()
{
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 0,
      '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
      'filter': 'alpha(opacity=0)'
    });
    $(".update-password-box").fadeIn(); 
}

function close_password_form(){
    $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 1,
      '-ms-filter':"",
      'filter': ''
    });
    $(".update-password-box").fadeOut();
    $("#password_error").html('');
    $("#drf_opass,#drf_npass,#drf_cpass").val('');
}

function check_old_email(eml){  
    if(eml !='')
  {
        jQuery.ajax({
            url:'<?php echo Yii::app()->createUrl("/business/myaccount/checkmail");?>',
            type:'POST',
            data:{eml:eml},
            success: function(result)
      {
                var obj = jQuery.parseJSON(result); 
                if(obj.success==false){ 
                    jQuery("#drf_email").val('');
                    jQuery("#drf_email").parent().addClass('mandatoryerror');
                    jQuery("#drf_email").attr('placeholder',obj.message); 
                }else {
                    jQuery("#drf_email").parent().removeClass('mandatoryerror');
                    jQuery("#drf_email").parent().removeClass('validtext');
                }                 
            }
        });
    }else {
        var atpos=eml.indexOf("@");            
        var dotpos=eml.lastIndexOf("."); 
        if(eml=="" || (atpos < 1 || dotpos<atpos+2 || dotpos+2>=eml.length)){
            JQ("#drf_email").parent().addClass('mandatoryerror');
            JQ("#drf_email").attr('placeholder','Please enter a valid email');
            failedvalidation = true;   
        } 
    }
}

function check_old_pwd(eml){  
    if(eml !='')
  {
        jQuery.ajax({
            url:'<?php echo Yii::app()->createUrl("/business/myaccount/checkoldpwd");?>',
            type:'POST',
            data:{eml:eml},
            success: function(result)
      {
                var obj = jQuery.parseJSON(result); 
                if(obj.success==false){ 
                    jQuery("#drf_opass").val('');
                    jQuery("#drf_opass").parent().addClass('mandatoryerror');
                    jQuery("#drf_opass").attr('placeholder',obj.message); 
                }else {
                    jQuery("#drf_opass").parent().removeClass('mandatoryerror');
                    jQuery("#drf_opass").parent().removeClass('validtext');
                }                 
            }
        });
    }else {
            JQ("#drf_opass").parent().addClass('mandatoryerror');
            JQ("#drf_opass").attr('placeholder','Please enter old password');
            failedvalidation = true;   
    }
}

// email form validations
function email_form_validation() { 
    var failedvalidation = false;
    var x = document.getElementById("drf_email").value;           
    var atpos=x.indexOf("@");            
    var dotpos=x.lastIndexOf(".");            
    if ((atpos < 1 || dotpos<atpos+2 || dotpos+2>=x.length))             
        {              
            $("#drf_email").parent().addClass('mandatoryerror');
            $("#drf_email").attr('placeholder','Please enter a valid email'); 
            failedvalidation = true;               
        }
    var y = document.getElementById("drf_nemail").value;           
    var atpos=y.indexOf("@");            
    var dotpos=y.lastIndexOf(".");            
    if ((atpos < 1 || dotpos<atpos+2 || dotpos+2>=y.length))             
        {              
            $("#drf_nemail").parent().addClass('mandatoryerror');
            $("#drf_nemail").attr('placeholder','Please enter a valid email'); 
            failedvalidation = true;               
        }   
    var em = document.getElementById("drf_nemail").value;
    var cem = document.getElementById("drf_cemail").value;           
    if (em != cem)             
    {              
       $("#drf_cemail").parent().addClass('mandatoryerror');
       $("#drf_cemail").attr('placeholder','Confirm Email does not Match'); 
        failedvalidation = true;              
    } 

    if(failedvalidation) return false;

    if(x !="" && em !=""){
         $.ajax({ 
             type: "POST",
             url: "<?php echo Yii::app()->createUrl('/business/myaccount/changeemail/'); ?>",
             async: false,
             data: 'type=edit_email&user_default_business_email='+x+'&user_default_business_nemail='+em,
             success: function(result)
             {
                var obj = jQuery.parseJSON(result); 
                if(obj.success){                    
                    $('#Business_user_default_business_email').val(em);
                    close_email_form(); 
                    show_msg(obj.message);
                    failedvalidation = false;

                //window.location.reload();
                }else {
                    $("#drf_nemail,#drf_cemail").parent().addClass('mandatoryerror');
                    $("#drf_nemail,#drf_cemail").attr('placeholder',obj.message); 
                      failedvalidation = true;
                     $("#drf_email,#drf_nemail,#drf_cemail").val('');
                } 
            },
            error: function(a)
             {
                 alert(a);
             }
        });
     }
    if (failedvalidation) 
    {
        return false;
    }
    return false;
}

jQuery("#UpdateSloganBtn").click(function(){
    var failedvalidation = false;
    var user_default_business_slogan = document.getElementById("user_default_business_slogan").value;
    if(user_default_business_slogan == "")
    {                
        jQuery("#user_default_business_slogan").parent().addClass('mandatoryerror');
        var closed= generate('error','Please Enter Slogan'); 
        failedvalidation = true;            
    } 
    if (failedvalidation) 
    {
        return false;
    }else {
           $.ajax({
             type: "POST",
             url: "<?php echo Yii::app()->createUrl('/business/myaccount/updateslogan/'); ?>",
             async: false,
             data: 'Myaccount_slogan='+user_default_business_slogan,           
             success: function(result)
             {  
                var obj = jQuery.parseJSON(result); 
                 if(obj.success){
                    close_slogan_form();
                    show_msg(obj.message);
                    $("#Business_user_default_business_slogon").val(user_default_business_slogan);
                }else {
                    $('#user_default_business_slogan_error').html(res[1]);
                      failedvalidation = true;
                    $("#user_default_business_slogan").val('');
                } 
            },
            error: function(a)
             {
                 alert(a);
             }
        });
      
    }
});

function currency_form_validation() 
{ 
 var failedvalidation = false;
 var currency_code = document.getElementById("Business_user_default_business_currency").value;
 var currencyName = $('#Business_user_default_business_currency').find(":selected").text();

 //alert(conceptName);
    if(currency_code == "")
    {                
       $("#Business_user_default_business_currency").parent().addClass('mandatoryerror');
       var closed= generate('error','Please Select the Currency Code');
       close_all_notice(closed);
        failedvalidation = true;            
    } 
    $.ajax({
             type: "POST",
             url: "<?php echo Yii::app()->createUrl('/business/myaccount/updatecurrency/'); ?>",
             async: false,
             data: 'type=edit_currency&Myaccount_user_default_business_currency='+currency_code,
             success: function(result)
             {  
                var obj = jQuery.parseJSON(result); 
                if(obj.success){
                    close_currency_form();
                    show_msg(obj.message);
                    $(".currency").html(currencyName);
                }else {
                    $('#currency_error').html(res[1]);
                      failedvalidation = true;
                    $("#currency_code").val('');
                }
            },
            error: function(a)
             {
                 alert(a);
             }
        });
    if (failedvalidation) 
    {
        return false;
    }
    return true;
}

// Password Form Validation
function password_form_validation()
  {
      var failedvalidation = false;
      var drf_opass = document.getElementById("drf_opass").value; 
      if(drf_opass == "")
        {                
          $("#drf_opass").parent().addClass('mandatoryerror');
          $("#drf_opass").attr('placeholder','Enter Your Password'); 
            failedvalidation = true;            
        } 
      var drf_pass = document.getElementById("drf_npass").value;
      if(drf_pass == "")
      {                
         $("#drf_npass").parent().addClass('mandatoryerror');
         $("#drf_npass").attr('placeholder','Enter Your Password'); 
        failedvalidation = true;            
      } 
      var drf_cpass = document.getElementById("drf_cpass").value;
      if(drf_cpass != drf_pass)
      {                
         $("#drf_cpass").parent().addClass('mandatoryerror');
         $("#drf_cpass").attr('placeholder','Confirm Password Does not match').val(''); 
        failedvalidation = true;            
      } 
             if (failedvalidation) 
            {
                 return false;
            }         
          loader();
          $.ajax({
              type :"POST", 
              url : "<?php echo yii::app()->createUrl('/business/myaccount/updatepassword/')?>",
              async: false,
              data : 'type=edit_password&user_default_business_opass='+drf_opass+'&user_default_business_npass='+drf_pass+'&user_default_business_cpass='+drf_cpass,
               success: function(result)
           {  
             loader();                     
                     var obj = jQuery.parseJSON(result); 
                     if(obj.success)
                     {
                        close_password_form(); 
                        show_msg(obj.message);
                        //close_all_notice(closed);
                        failedvalidation = false;
                        //window.location.reload();
                     }else
                     {
                        $('#drf_'+obj.referto+'pass').parent().addClass('mandatoryerror');
                        $('#drf_'+obj.referto+'pass').attr('placeholder',obj.message).val(''); 
                       // $('#password_error').html(result.message);
                        failedvalidation = true;
                        //$("#drf_opass,#drf_npass,#drf_cpass").val('');
                     }
              },
          error: function(a)
           {
            alert(a);
           }    
        });
  }

function bussinesscheckdod(){ 
    var status = true;
    $.ajax({
        async: false,
        url:baseUrl+'/ajax/checkdob',
        method: 'post',
        data: "dob="+$("#Business_user_default_business_dob").val(),
        success:function(transport) {
            var get_message = $.parseJSON(transport);
            if(get_message.success=="false")
            {
                $("#Business_user_default_business_dob").val('') ;
                $("#Business_user_default_business_dob").parent().addClass('mandatoryerror'); 
                $("#Business_user_default_business_dob").attr('placeholder','You must be over 18yrs to register'); 
                status = false;
            } 
        }
    }); 
    return status;
} 

function show_picture_form(){

   //jQuery("#user_default_business_image").trigger("click");
   $(".my-account-links,#update-table,.fBtn").css({
      'opacity': 0,
      '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
      'filter': 'alpha(opacity=0)'
    });
    jQuery(".photo-upload-box").show();  
 }
 
 function hide_picture_form(){
    //jQuery("#user_default_business_image").trigger("click");
    jQuery(".my-account-links,#update-table,.fBtn").css({
     'opacity': 1,
     '-ms-filter':"",
     'filter': ''
    });
    jQuery(".photo-upload-box").hide();  
  }
</script>
<!--</div>-->