<style type="text/css">

    #more_record_chzn {
        top: 0px;
        left: 10px;
    }

    .more_record_chzn_pagination {
        top: -35px !important;
        left: 10px !important;

    }

    .more_record_label_pagination {
        position: relative;
        top: -43px !important;
        left: 0px !important;
        color: #AC5099;
    }

    .more_record_label {
        position: relative;
        top: -9px;
        left: 0px;
        color: #AC5099;
    }

    .chzn-search input{
        width: 37px !important;
    }

    .Container > .breadcrumb {
        top: 63px !important;
    }

</style>

<?php

$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl.'/js/chosen.jquery.js');
$js->registerCssFile($baseUrl.'/css/chosen.css');

?>
<div class="form">
<?php 
// $logtime = Logtransaction::totalLoggedTime($model->user_default_id);
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
	'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
  'clientOptions'=>array(
    'validateOnSubmit'=>true,
  ),
   //  'action'=>Yii::app()->createUrl("/admin/member/update",array("id"=>$model->user_default_id)),
)); ?>

    <div class="user-profile-update-notify">
              <div id="terms-conditions" class="u-email-box"> 
                <div class="my-account-popup-box"> 
                	<a title="Close" href="javaScript:void(0)" onclick="close_email_form()" class="pu-close">X</a>
                  <h2 style="color:#805CA2;">User Profile Update Notification</h2>
                    <div id="update-table">

                      <div>&nbsp;</div>
                        <table border="0" cellpadding="0" cellspacing="0" id="update-table">
                            <tbody>
                            <tr>
                                <td class="label">Subject <span class="mandatory-field">*</span></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="Your Profile was Updated" name="update_subject" id="update_subject" tabindex="1" class="value"> </td>
                            </tr>
                            <tr>
                                <td class="label">Message <span class="mandatory-field">*</span></td>
                            </tr>
                            <tr>
                                <td><textarea id="message" class="value" name="message" placeholder="Please enter your message here" rows="3" cols="90" tabindex="2"></textarea> </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    <span class="middle">


                        <input name="btnsend" id="btnsend" value="Send" type="button" class="button update-green" tabindex="3" onclick="update_notify_form_validation()" />
                    </span>
                    </div>
                </div>
              </div>
            </div>

<div class="profile_activate_account">
    <div id="terms-conditions" class="u-email-box">
        <div class="my-account-popup-box">
            <a title="Close" href="javaScript:void(0)" onclick="close_profile_activation_form()" class="pu-close">X</a>
            <h2 style="color:#805CA2;">User Profile Activation Notification</h2>
            <div>&nbsp;</div>
            <div id="update-table">
                <table border="0" cellpadding="0" cellspacing="0" id="update-table">
                    <tbody>
                    <tr>
                        <td class="label">Subject</td>
                    </tr>
                    <tr>
                        <td><input type="text" value="User Account Activation Notice" class="value" id="activation_subject" name="activation_subject" ></td>
                    </tr>
                    <tr>
                        <td class="label">Message <span class="mandatory-field">*</span></td>
                    </tr>
                    <tr>
                        <td><textarea id="activation_message" name="activation_message" placeholder="Please enter your message here" rows="3" cols="60" class="value" ></textarea> </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                    <span class="middle">
                        <input name="btnsend" id="btnsend" value="Send" type="button" class="button update-green"  onclick="activation_form_validation()" />
                    </span>
    </div>
        </div>
    </div>
</div>

<div class="profile_suspend_account">
    <div id="terms-conditions" class="u-email-box">
        <div class="my-account-popup-box">
            <a title="Close" href="javaScript:void(0)" onclick="close_profile_suspension_form()" class="pu-close">X</a>
            <h2 style="color:#805CA2;">User Profile Suspension Notification</h2>
            
            <div>&nbsp;</div>
            <div id="update-table">
                <table border="0" cellpadding="0" cellspacing="0" id="update-table">
                    <tbody>
                    <tr>
                        <td class="label">Subject</td>
                    </tr>
                    <tr>
                        <td><input type="text" value="User Account Suspension Notice" class="value" id="suspension_subject" name="suspension_subject" ></td>
                    </tr>
                    <tr>
                        <td class="label">Message <span class="mandatory-field">*</span></td>
                    </tr>
                    <tr>
                        <td><textarea id="suspension_message" name="suspension_message" placeholder="Please enter your message here" rows="3" cols="60" class="value" ></textarea> </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                    <span class="middle">


                        <input name="btnsend" id="btnsend" value="Send" type="button" class="button update-green"  onclick="suspension_form_validation()" />
                    </span>
            </div>
        </div>
    </div>
</div>

<div class="send-mail">
    <div id="terms-conditions" class="u-email-box">
        <div class="my-account-popup-box">
            <a title="Close" href="javaScript:void(0)" onclick="close_send_email_form()" class="pu-close">X</a>
            <h2 style="color:#805CA2;">Send email to member</h2>
            <div id="email_error" class="error_msg"></div>
            <div id="update-table">
            <div>&nbsp;</div>
            <div align="right"><span class="mandatory-field">*</span> All fields are required</div>
            <table border="0" cellpadding="0" cellspacing="0" id="update-table">
                <tbody>
                <tr>
                    <td class="label">Subject<span class="mandatory-field">*</span></td>
                </tr>
                <tr>
                    <td><input type="text" id="subject" name="subject" value="Your Profile was Updated" tabindex="1" size="30"></td>
                </tr>
                <tr>
                    <td class="label">Message <span class="mandatory-field">*</span></td>
                </tr>
                <tr>
                    <td><textarea id="email_message" name="email_message" placeholder="Please enter your message here" rows="3" cols="60" tabindex="2"></textarea> </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>

                </tbody>
            </table>

                <input name="btncancel" value="Cancel" id="btncancel" type="button" class="button black" onclick="close_send_email_form()"  />&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="btnsendemail" value="Send" id="btnsendemail" type="button" class="button update-green" onclick="send_email_form_validation()"  />


        </div>
            </div>
    </div>
</div>

<div class="userData">
  <fieldset>
    <?php if($model->user_default_type=='business'){?>
    <p>
      <?php //echo $form->labelEx($model,'co_sector',array('class'=>'field')); ?>
      <?php //echo $form->dropDownList($model,'co_sector',CHtml::listData(ListingProfession::getAll(),'list_profession_id','list_profession_name'), array('prompt' => 'Please Select')); ?>
      <?php //echo $form->error($model,'co_sector'); ?>
    </p>
    <p>
      <?php echo $form->labelEx($model,'co_name',array('class'=>'field')); ?>
      <?php echo $form->textField($model,'co_name',array('size'=>50)); ?>
      <?php echo $form->error($model,'co_name'); ?>
    </p>
    <p>
      <?php echo $form->labelEx($model,'co_slogon',array('class'=>'field')); ?>
      <?php echo $form->textField($model,'co_slogon',array('size'=>50)); ?>
      <?php echo $form->error($model,'co_slogon'); ?>
    </p>
    <?php  }
	
	$useraddress = Useraddress::model()->find(
                              array(
                              'condition'=>'user_default_profile_id= "'.$model->user_default_id.'" ',
                              'order'=>'user_default_address_id DESC'
                             )); 
	if($useraddress)
	{
		
	}
	else
	{
		$useraddress = new Useraddress;
	}


	?>
	<p>
		<?php echo $form->labelEx($model,'user_default_first_name',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'user_default_first_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_default_first_name'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'user_default_surname',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'user_default_surname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_default_surname'); ?>
	</p>
 
    <p>
      <?php echo $form->labelEx($model,'user_default_gender',array('class'=>'field')); ?>
	  <select tabindex="7" class="chzn-select" name="gender" id="Member_user_default_gender">
      <option value="">Select</option>
	  <option value="m" <?php if($model->user_default_gender == "m") { ?> selected="selected" <?php } ?> >Male</option>
      <option value="f" <?php if($model->user_default_gender == "f") { ?> selected="selected" <?php } ?> >Female</option>
      </select>
    </p>
	
	<!--<p>
      <?php /*echo $form->labelEx($model,'user_default_type',array('class'=>'field')); ?>
       <?php echo $form->dropDownList($model,'user_default_type', array('user'=>"User",'business'=>"Business"), array('prompt' => 'Select','tabindex'=>7,'class'=>'chzn-select')); ?>
      <?php echo $form->error($model,'user_default_type'); */ ?>
    </p>-->
 
	<p>
		<?php echo $form->labelEx($model,'user_default_email',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'user_default_email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_default_email'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'user_default_username',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'user_default_username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_default_username'); ?>
	</p>
	<?php
	if($model->user_default_id == "")
	{
		?>
		<p>
		<?php echo $form->labelEx($model,'user_default_password',array('class'=>'field')); ?>
		<?php echo $form->passwordField($model,'user_default_password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_default_password'); ?>
	</p>
		
		<?php
	}
	?>
	<p>
		<?php echo $form->labelEx($useraddress,'user_default_address1', array('class'=>'field')); ?>
		<?php echo $form->textField($useraddress,'user_default_address1',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($useraddress,'user_default_address1'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($useraddress,'user_default_address2', array('class'=>'field')); ?>
		<?php echo $form->textField($useraddress,'user_default_address2',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($useraddress,'user_default_address2'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($useraddress,'user_default_address3', array('class'=>'field')); ?>
		<?php echo $form->textField($useraddress,'user_default_address3',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($useraddress,'user_default_address3'); ?>
	</p>
	 

	<p>
		<?php echo $form->labelEx($useraddress,'user_default_town', array('class'=>'field')); ?>
		<?php echo $form->textField($useraddress,'user_default_town',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($useraddress,'user_default_town'); ?>
	</p>
  
  <p>
    <?php echo $form->labelEx($useraddress,'user_default_county',array('class'=>'field')); ?>
    <?php echo $form->textField($useraddress,'user_default_county',array('size'=>60,'maxlength'=>200)); ?>
    <?php echo $form->error($useraddress,'user_default_county'); ?>
  </p>

  <p>
    <?php echo $form->labelEx($model,'user_default_currency',array('class'=>'field')); ?>
    <?php $cur = CHtml::listData(Currency::model()->findAll(),'currency_id', 'currency_name');?>
     <?php echo $form->dropDownList($model,'user_default_currency',$cur, array('prompt' => 'Please Select','class'=>'chzn-select')); ?>
    <?php echo $form->error($model,'user_default_currency'); ?>
  </p>

	<p>
		<?php echo $form->labelEx($useraddress,'user_default_zip', array('class'=>'field')); ?>
		<?php echo $form->textField($useraddress,'user_default_zip',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($useraddress,'user_default_zip'); ?>
	</p>

	<p>
    	  <?php  $data = CHtml::listData(Country::getAll(), 'user_default_country_id', 'user_default_country_name');?>
          <?php echo $form->labelEx($model,'user_default_country', array('class'=>'field')); ?>
          <?php echo $form->dropDownList($model,'user_default_country',$data, array('prompt' => 'Please Select')); ?>
          <?php echo $form->error($model,'user_default_country'); ?>
   </p>

	<p>
		<?php echo $form->labelEx($model,'user_default_tel', array('class'=>'field')); ?>
		<?php echo $form->textField($model,'user_default_tel',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'user_default_tel'); ?>
	</p>
    <?php if($model->user_default_type=='business'){?>
    <p>
		<?php echo $form->labelEx($model,'co_fax',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'co_fax',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'co_fax'); ?>
	</p>
  <?php } ?>

<!-- 	<p>
		<?php //echo $form->labelEx($model,'user_default_gender', array('class'=>'field')); ?>
        <?php //echo $form->dropDownList($model,'user_default_gender', array('Male'=>"Male",'Female'=>"Female"), array('prompt' => 'Select','options' => array($model->user_default_gender =>array('selected'=>true)))); ?>
		<?php //echo $form->error($model,'user_default_gender'); ?>
	</p> -->

	<p>
		<?php echo $form->labelEx($model,'user_default_dob', array('class'=>'field')); ?>
		<?php //echo $model->user_default_dob;
           $maxYear = date('Y') - 18;
           $yearRange = "1900:$maxYear";
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
               'name'=>'dob',
               'model'=>$model->user_default_dob,
               'flat'=>false,//remove to hide the datepicker
               'value'=>date('d/m/Y',strtotime($model->user_default_dob)),
               'options'=>array(
                   'dateFormat' => 'd/m/yy',
                   'showAnim'=>'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                   'changeMonth'=>true,
                   'changeYear'=>true,
                   'yearRange'=>$yearRange,
                   'minDate'=>'01/01/1900',
                   'maxDate' => date('t/').'12/'.$maxYear,
                   //'defaultDate'=> $model->user_default_dob ? '':date('d/m/').$maxYear,
                   'onSelect'=>'js: function(dateText, inst) {myaccountdod()}',  
               ),
               'htmlOptions'=>array(
                   'placeholder'=>'DD  /  MM  /  YYYY ',
                   'tabindex'=>8, 
                   'readonly'=>'readonly',  
               ),
           )); 
     ?>   
		<?php echo $form->error($model,'user_default_dob'); ?>
	</p>

	<?php /* ?><p>
    	<?php $data = CHtml::listData(Question::getAll(), 'drg_question', 'drg_question');?>
        <?php echo $form->labelEx($model,'drg_question', array('class'=>'field')); ?>
        <?php echo $form->dropDownList($model,'drg_question',$data, array('prompt' => 'Select','options'=>array($model->drg_question=>array("selected"=>true)))); ?>
        <?php echo $form->error($model,'drg_question'); ?>
		
	</p>

	<p>
		<?php echo $form->labelEx($model,'drg_answer',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'drg_answer',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'drg_answer'); ?>
	</p>
	<?php */ ?>
	
	<?php if($model->user_default_type=='business'){?>
	<p>
     	<?php echo $form->labelEx($model,'co_title',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'co_title',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'co_title'); ?>		
	</p>
    
    <p>
		<?php echo $form->labelEx($model,'co_website',array('class'=>'field')); ?>
		<?php echo $form->textField($model,'co_website',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'co_website'); ?>
	</p>
    <?php } ?>
	

   	
   </fieldset>
</div>

<div class="userListingData">
	<?php /*<div class="profile-pic">
        <?php 
        if($model->drg_image){
            $img = $model->drg_image;            
        }else {
            $img = 'avatar.jpg';
        }
        ?>
    	<div class="pro-photo">
            <img src="../<?php echo IMG_LOGO_PATH.$img;?>" alt="<?php Yii::app()->params['company_name']; ?>" />
        </div>
            <div class="profile-detail">
                 <ul>
                     <li><label class="field">Member since:</label><?php echo $model->user_default_registration_date; ?> </li>
                     <li><label class="field">Status:</label> Online</li>
                     <li><label class="field">Prize wins:</label>0 </li>
                     <li><label class="field">Total won:</label>0 </li>
                     <li><label class="field">Time logged this month:</label>
                      <?php echo $this_month = ActivityDate::getTimeThisMonth($model->user_default_id);?> hrs
                     </li>
                     <li><label class="field">Average time logged per month:</label> <?php echo ActivityDate::getAvgPerMonth($model->user_default_id); ?> hrs</li>
                     <li><label class="field">Points total this month:</label><?php echo $this_month*60; ?> </li>
                 </ul>                
            </div>
       
    </div>*/?>
	   <?php 
     if(!$model->isNewRecord)
     {
     ?>
     <table class="gernal_table" border="0" style="background-color:#fff" width="100%" cellpadding="1" cellspacing="2">
      <tr class="tableHeading">
        <td class="" style="cursor:default" title="Date of submission">Register Date</td>
        <td class="title_column" style="cursor:default;" title="Title of listing">Title</td>
        <td class="status_column" style="cursor:default;" title="Status">Active</td>
      </tr>
    		<tr>
            	<td>
                    <?php echo $model->user_default_registration_date; ?>                    
				 </td>             
             	<td>
                    <?php $profession = Profession::model()->findByPk($data->user_default_profession); echo $profession->profession_name; ?>			 
             	<td>
             	<?php echo ucfirst($model->user_default_account_status); ?>
				 
           </tr> 
    </table>
    <br/>
	<span>Listing History</span>
	<table class="gernal_table" border="0" style="background-color:#fff" width="100%" cellpadding="1" cellspacing="2">
      <tr class="tableHeading">
        <td class="" style="cursor:default" title="Date of submission">Date</td>
        <td class="title_column" style="cursor:default;" title="Title of listing">Listing Title</td>
        <td class="status_column" style="cursor:default;" title="Status">Listing Status</td>
      </tr>

      <?php 
        if($model->user_default_type == "business"){
          $criteria1 = new CDbCriteria;
          // $criteria1->compare('approved',1,true);
          $criteria1->compare('drg_uid',$model->drg_uid,true); 
          $criteria1->order = 'drg_blistingstatus asc,drg_blid desc';
          $listings = Businesslisting::model()->findAll($criteria1); 
          if($listings){
            foreach ($listings as $listing) {?>
              <tr>
                <td><?php echo date('Y-m-d',strtotime($listing->user_default_listing_datetime));?></td>
                <td><?php echo $listing->drg_slogon;?></td>
                <td>
                  <?php 
                  if($listing->drg_blistingstatus == "2"){
                    echo "<span style='color:red;'>Rejected</span>";
                  }
                  else if($listing->drg_blistingstatus =="1")
                       { 
                            echo "Approved"; 
                           }
                       else {
                            echo "Waiting for publication"; 
                           } ?></td>
              </tr>
            <?php  
            }
          }
          else{ ?>
            <tr>
                <td colspan="3">No listings by the user.</td>
            </tr>
            <?php
          }
        }
        else{
          $criteria1 = new CDbCriteria;
          // $criteria1->compare('user_default_listing_submission_status',1,true);
          // $criteria1->compare('reject_list',0,true);
          $criteria1->compare('user_default_profiles_id',$model->user_default_id,true); 
          $criteria1->order = 'user_default_listing_submission_status desc,user_default_listing_id desc';
          $listings = Userlisting::model()->findAll($criteria1); 
          if($listings){
            foreach ($listings as $listing) {?>
              <tr>
                <td><?php echo $listing->user_default_listing_date;//date('Y-m-d',strtotime($listing->user_default_listing_date));?></td>
                <td><?php echo $listing->user_default_listing_title;?></td>
                <td>
                  <?php 
                  if($listing->user_default_listing_submission_status == "1"){
                    echo "Approved";
                  }
                  else{
                            echo "Waiting for publication"; 
                           } ?></td>
              </tr>
            <?php  
            }
          }
          else{ ?>
            <tr>
                <td colspan="3">No listings by the user.</td>
            </tr>
            <?php
          }
        }
      ?>
    	
    </table>
	<br />
    <?php } ?>
	
	

    <div>
		<h2><?php echo $form->labelEx($model,'user_default_admin_notes'); ?></h2>
		<?php echo $form->textArea($model,'user_default_admin_notes',array('rows'=>9, 'cols'=>100, 'width'=>300)); ?>
		<?php echo $form->error($model,'user_default_admin_notes'); ?>
       
	</div>
    
</div>
<div class="clearBoth space"></div>
  <br/><br/><br/>
  <div class="userData_btns">
	<div class="row buttons">
	
	<?php 
	$data=array(
	'id'=>'".$model->user_default_id."',
	'user_default_first_name'=>'test');
	
	?>
    	<a href="<?php echo Yii::app()->createUrl('/admin/member'); ?>" class="button gray">New search</a>
		
		<?php if($model->isNewRecord){
            echo CHtml::submitButton('Create', array('class' => 'button update-green')); ?>

		<?php
			//echo CHtml::submitButton('Create', array('class' => 'button green'));
		}else{ /*echo CHtml::submitButton('Update Profile', array('class' => 'button update-green'));*/?>
    			<a class="button update-green update" href="javascript:void(0);" id="update-profile-btn" >Update Profile</a>
<?php
			//<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update Profile', array('class' => 'button green update')); ?>     
		<?php //echo Yii::app()->createUrl('/admin/member/updatenotifyemail',array('id'=>$model->user_default_id)); ?>
	<?php 	 /*<a href="<?php echo Yii::app()->createUrl('/admin/member/updatenotifyemail',array('id'=>$model->user_default_id)); ?>" id="updateProfile" class="button green update" >Update Profile</a> */?>
		 <?php } ?>
     <?php 
     if(!$model->isNewRecord)
     {
     ?>          
       <a href="javascript:void(0);"  class="button blue various" >Send Email</a>
       <?php 
        
       if(strtolower($model->user_default_account_status)=='1'){       
       ?>       
            <a href="javascript:void(0);" class="button pink suspend_account">Suspend Account</a>
       <?php
       }else{ 
       ?>
            <a href="javascript:void(0);" class="button white activate_account" >Activate Account</a>
      <?php
      }
      ?>  
	  
      <a  onclick="return confirm('Are you sure you want to delete the user? This action cannot be undone.');" href="<?php echo Yii::app()->createUrl('/admin/member/delete',array('id'=>$model->user_default_id));?>" class="button red delete" >Delete Account</a>
	
    <?php
    }
    ?>
    </div>
    </div>

<?php $this->endWidget(); ?>
<div id="screen">
</div>
</div><!-- form -->


<script type="text/javascript">
    //jQuery(".chzn-select").chosen();
    jQ = jQuery.noConflict();
    jQ(".user-profile-update-notify").fadeOut();
    jQ(".send-mail").fadeOut();
    jQ(".profile_activate_account").fadeOut();
    jQ(".profile_suspend_account").fadeOut();

     jQ(document).ready(function(){
      /*jQ('#update-profile-btn').click(function(e){
			e.preventDefault();
			jQ(this).closest('form').submit();
		});*/
         jQ('input,textarea').focus(function(){
             jQ(this).removeAttr('placeholder');
         });
     jQ('#update-profile-btn').click(function(e){
	    jQ(".user-profile-update-notify").fadeIn();


     });
     jQ('a.various').click(function(e){

         jQ('#screen').css({ opacity: 0.6, 'width':'100%','height':'100%'});
         jQ('body').css({'overflow':'overflow'});
         jQ(".send-mail").fadeIn();
     });
     jQ('a.activate_account').click(function(e){
         jQ(".profile_activate_account").fadeIn();
         jQ('#screen').css({ opacity: 0.6, 'width':'100%','height':'100%'});
         jQ('body').css({'overflow':'overflow'});
     });

         jQ('a.suspend_account').click(function(e){
         jQ(".profile_suspend_account").fadeIn();
         jQ('#screen').css({ opacity: 0.6, 'width':'100%','height':'100%'});
         jQ('body').css({'overflow':'overflow'});
     });
	});

// Change colour of table row on mouse over
function ChangeColorMauve(tableRow, highLight)
{
	if (highLight)
		{
			tableRow.style.backgroundColor = '#C9C';
		}
	else
		{
			tableRow.style.backgroundColor = '#EADDED';
		}
}

function ChangeColorGrey(tableRow, highLight)
{
	if (highLight)
		{
			tableRow.style.backgroundColor = '#C2C2C2';
		}
	else
		{
			tableRow.style.backgroundColor = '#EBEBEB';
		}
}

function DoNav(theUrl)
{
	document.location.href = theUrl;
}

function close_email_form(){
jQ(".user-profile-update-notify").fadeOut();
}

    function close_send_email_form()
    {
        jQ(".send-mail").fadeOut();
        jQ('#screen').removeAttr('style');
        jQ('body').removeAttr('style');
    }
    function close_profile_suspension_form()
    {
        jQ(".profile_suspend_account").fadeOut();
        jQ('#screen').removeAttr('style');
        jQ('body').removeAttr('style');
    }

    function close_profile_activation_form()
    {
        jQ(".profile_activate_account").fadeOut();
        jQ('#screen').removeAttr('style');
        jQ('body').removeAttr('style');
    }

// form validations
function update_notify_form_validation() {

    var failedvalidation = false;
 	var message = jQ('#message').val();
    var subject = jQ('#update_subject').val();
    var usertype = '<?php echo $model->user_default_type; ?>';


    if(subject == '' || message == ''){

        if(subject == ''){
            jQ("#update_subject").css('border','2px solid #f00');

        }
        if(message == ''){
            jQ("#message").css('border','2px solid #f00');
        }

        failedvalidation = true;
        return false;
    }
	else{

        var d1=jQ('#member-form').serialize();
        var d1 = d1 + '&id=<?php echo $model->user_default_id;?>';

        jQ.ajax({
             type: "POST",
             url: "<?php echo Yii::app()->baseUrl; ?>/admin/member/updatenotifyemail",
             data:  d1 ,
             success: function(result)
             {
                    if(result =='success'){
                        jQ(".user-profile-update-notify").fadeOut();
                        jQ('#screen').removeAttr('style');
                        jQ('body').removeAttr('style');

                        if(usertype=='user')
                        {
                            window.location.href="<?php echo Yii::app()->baseUrl; ?>/admin/member/index";
                        }else{
                                window.location.href="<?php echo Yii::app()->baseUrl; ?>/admin/member/business";
                        }
                    }
        	},
            error: function(e)
            {
                alert(e.message);
            }
  		});
     }
 	if (failedvalidation) 
	{
        return false;
    }
    return false;
}

function suspension_form_validation()
{
    var failedvalidation = false;
    var sendmessage = jQ('#suspension_message').val();
    var subject = jQ('#suspension_subject').val();
    if(subject == '' || message == ''){

        if(subject == ''){
            jQ("#suspension_subject").css('border','2px solid #f00');

        }
        if(message == ''){
            jQ("#message").css('border','2px solid #f00');
        }

        failedvalidation = true;
        return false;
    }
    else{
        var d1 ='id=<?php echo $model->user_default_id;?>&subject='+subject+'&message='+sendmessage;
        jQ.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->baseUrl; ?>/admin/member/suspend",
            data:  d1 ,
            success: function(result)
            {
                if(result == 'success'){
                    jQ(".profile_activate_account").fadeOut();
                    jQ('#screen').removeAttr('style');
                    jQ('body').removeAttr('style');


                    window.location.href="<?php echo Yii::app()->baseUrl.'/admin/member/update?id='.$model->user_default_id; ?>";
                }
            },
            error: function(e)
            {
                alert(e.message);
            }
        });
    }
    if (failedvalidation)
    {
        return false;
    }
    return false;

}

    function activation_form_validation()
    {
        var failedvalidation = false;
        var sendmessage = jQ('#activation_message').val();
        var subject = jQ('#activation_subject').val();
        if(subject == '' || message == ''){

            if(subject == ''){
                jQ("#activation_subject").css('border','2px solid #f00');

            }
            if(message == ''){
                jQ("#activation_message").css('border','2px solid #f00');
            }

            failedvalidation = true;
            return false;
        }
        else{
            var d1 ='id=<?php echo $model->user_default_id;?>&subject='+subject+'&message='+sendmessage;
            jQ.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->baseUrl; ?>/admin/member/activate",
                data:  d1 ,
                success: function(result)
                {
                    if(result == 'success'){
                        jQ(".profile_activate_account").fadeOut();
                        jQ('#screen').removeAttr('style');
                        jQ('body').removeAttr('style');

                        window.location.href="<?php echo Yii::app()->baseUrl.'/admin/member/update?id='.$model->user_default_id; ?>";
                    }
                },
                error: function(e)
                {
                    alert(e.message);
                }
            });
        }
        if (failedvalidation)
        {
            return false;
        }
        return false;

    }

    function send_email_form_validation()
    {
        var failedvalidation = false;
        var sendmessage = jQ('#email_message').val();
        var subject = jQ('#subject').val();
        /*if(subject == ''){
            jQ("#subject").css('border','2px solid #f00');
            failedvalidation = true;
            return false;
        }
        else if(sendmessage == ''){
            // jQ("#message").parent().addClass('mandatoryerror');
            //jQ("#message").attr('placeholder','Please enter a message ');
            jQ("#email_message").css('border','2px solid #f00');
            failedvalidation = true;
            return false;
        }*/
       if(subject == '' || sendmessage == ''){

           if(subject == ''){
               jQ("#subject").css('border','2px solid #f00');

           }
           if(sendmessage == ''){
               jQ("#email_message").css('border','2px solid #f00');
           }

           failedvalidation = true;
           return false;
       }
       else{
            var d1 ='id=<?php echo $model->user_default_id;?>&subject='+subject+'&message='+sendmessage;
            jQ.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->baseUrl; ?>/admin/member/sendmail",
                data:  d1 ,
                success: function(result)
                {
                    if(result == 'success'){
                        jQ(".send-mail").fadeOut();
                        jQ('#screen').removeAttr('style');
                        jQ('body').removeAttr('style');

                    }
                },
                error: function(e)
                {
                    alert(e.message);
                }
            });
        }
        if (failedvalidation)
        {
            return false;
        }
        return false;

    }
</script>

<?php  ?>








 

 
   
