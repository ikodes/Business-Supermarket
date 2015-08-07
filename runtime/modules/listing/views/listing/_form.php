<?php 
    $this->renderPartial('//../modules/listing/views/layouts/default_slider');           
?> 

<div class="clear"></div>
<div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
    <div class="clear"></div>
</div>
<div class="registration-content" style="min-height:596px"> 
        <div class="my-account-links">
          <?php 
            $this->renderPartial("//layouts/my-account-links");
          ?>
        </div> 
        <div style="float:right;">
       <!-- Confirm close pop up -->        
        <div class="confirm">
          <div class="u-email-box"> 
          	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png" style="z-index:999999; position:relative; top:2px;" />
            <div class="my-account-popup-box" style="margin-top:-38px !important"> 
              <a title="Close" href="javaScript:void(0)" onclick="close_form()" class="pu-close">X</a>
              <br />
              <h2 class="Blue">Are you sure you want to leave this page?</h2>
              <p><em>Your form data has not been saved  leaving the listing submission process now will result in any data you have submitted being lost.<br /> 
                      Please save your listing first.</em></p>              
              <table align="center" width="100%">
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
              	<tr>              	
              	<td align="center">                 
                    
                    <input class="button black" style="margin: 0 10px;" title="Close and return to form" name="canle" type="button" value="Cancel"  onclick="jQuery('.confirm').hide('slow');jQuery('.photo-upload-boxs').removeClass('hiddenbox');"/> 
                    <input class="button black" style="margin: 0 10px;" onclick="window.location.href='<?php echo Yii::app()->createUrl('user/myaccount/update'); ?>'" title="Save and close form" name="register" type="button" value="Save &#38; Close"  />
                    <input class="button black" style="margin: 0 10px;" name="register" type="button" title="Discard ALL data and close form" value="Discard"  onclick="window.location.href='<?php echo Yii::app()->createUrl('user/myaccount/update'); ?>'" />              
                 
                </td>
              </tr>
              </table>
            </div>
          </div>
        </div>       
    <!-- end close--> 
        
             <h2 align="center" class="Blue">Create a User listing</h2>
               <i style="color:#999999; margin-left:28px;">Please enter/check your address details and enter a business name if you have one.</i>
                <div class="photo-upload-boxs"> 
                    <img style="width:121px; left:87px" class="side-robot-upload" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/pink-robot-1.png" alt=""/>
                        <div class="my-account-popup-box user-listing">
                        	<a class="pu-close pu-close1" href="javascript:void(0);" title="Close">X</a> 
                			<div style="width:450px;">
                				<div class="busi_details">Business Details</div>
                				<div class="busi_content">
                					<i>
                						These details are not visible on your listing and are totally private.<br />
                						They will be used to create a portfolio of your business idea.
                					</i>
                				</div>
                			</div>
                		 <!--<form name="create_listing" id="create_listing" method="post" action="#" onSubmit="return form_validation();">-->
                            <?php $form=$this->beginWidget('CActiveForm', array('id'=>'userlisting-form','enableAjaxValidation'=>false,'htmlOptions'=>array("onsubmit"=>'return form_validation();'))); ?>				
                		   
 <table width="100%" style="float: left;">   
 
						 		   <?php   
								   $model_new = Listingaddress::model()->find("user_default_listing_id ='".$model->user_default_listing_id."' ");
							    if($model_new){                      
                                    //$modelNew = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getId()."' and  user_default_listing_id ='".$model->user_default_listing_id."' ");
									$address = Listingaddress::model()->find("user_default_listing_id ='".$model->user_default_listing_id."' ");
                                 }
                                else {
	                           	    $address = new Listingaddress; 
                                 }   
?>								 
                                                   	
                			<tr>
                				<td width="35%" align="right"><label>Company Name</label></td>
                				<td width="65%" colspan="2">
                                   <input type="hidden" name="btnsaveforlater" value="0" id="btnsaveforlater" />
                                    
                                  <?php 
                                  if(!empty($address->user_default_listing_company_name)) {
                               echo CHtml::textField('Listingaddress[user_default_listing_company_name]', $address->user_default_listing_company_name,array('id'=>'company_name','class'=>'file_input_textbox', 'width'=>100,'maxlength'=>100));
                                   }else {
                                     echo $form->textField($address,'user_default_listing_company_name',array('id'=>'company_name','size'=>50,'maxlength'=>50,'class'=>'file_input_textbox'));  
		                           }
								   echo $form->error($address,'user_default_listing_company_name'); 
                                 ?>                                                               
                                </td>
                			</tr>
                			<tr>
                				<td align="right" valign="top"><label>Address 1</label></td>
                				<td>
                                  <?php 
                                   if(!empty($address->user_default_listing_address1)){
                                    
                                        echo CHtml::textField('Listingaddress[user_default_listing_address1]', $address->user_default_listing_address1,array('class'=>'file_input_textbox', 'width'=>100,'maxlength'=>100, 'id'=>'address1'));                                          
		                           
                                   }else {
                                        echo $form->textField($address,'user_default_listing_address1',array('class'=>'file_input_textbox', 'width'=>100,'maxlength'=>100, 'id'=>'address1')); 
                                   }
                                  echo $form->error($address,'user_default_listing_address1');
                                  ?>
                                </td>
                				<td class="mandatory-field">*</td>
                			</tr>	

	<tr>
                				<td align="right" valign="top"><label>Address 2</label></td>
                				<td>
                                  <?php 
                                   if(!empty($address->user_default_listing_address2)){
                                    
                                        echo CHtml::textField('Listingaddress[user_default_listing_address2]', $address->user_default_listing_address2,array('class'=>'file_input_textbox', 'width'=>100,'maxlength'=>100, 'id'=>'address2'));                                          
		                           
                                   }else {
                                        echo $form->textField($address,'user_default_listing_address2',array('class'=>'file_input_textbox', 'width'=>100,'maxlength'=>100, 'id'=>'address2')); 
                                   }
                                  echo $form->error($address,'user_default_listing_address2');
                                  ?>
                                </td>
                				<td class="mandatory-field">*</td>
                			</tr>	

	<tr>
                				<td align="right" valign="top"><label>Address 3</label></td>
                				<td>
                                  <?php 
                                   if(!empty($address->user_default_listing_address3)){
                                    
                                        echo CHtml::textField('Listingaddress[user_default_listing_address3]', $address->user_default_listing_address3,array('class'=>'file_input_textbox', 'width'=>100,'maxlength'=>100, 'id'=>'address3'));                                          
		                           
                                   }else {
                                        echo $form->textField($address,'user_default_listing_address3',array('class'=>'file_input_textbox', 'width'=>100,'maxlength'=>100, 'id'=>'address3')); 
                                   }
                                  echo $form->error($address,'user_default_listing_address3');
                                  ?>
                                </td>
                				<td class="mandatory-field">*</td>
                			</tr>	

							
                			<tr>
                				<td align="right"><label>Town</label></td>
                				<td>
                                
                                <?php 
                                if(!empty($address->user_default_listing_town)){
                                     echo CHtml::textField('Listingaddress[user_default_listing_town]',$address->user_default_listing_town,array('id'=>'town','class'=>'file_input_textbox', 'width'=>100,'maxlength'=>100));
                                }else {
                                    echo $form->textField($address,'user_default_listing_town',array('size'=>60,'maxlength'=>100,'id'=>'town','class'=>'file_input_textbox'));
                                }
                                  echo $form->error($address,'user_default_listing_town'); 
                                ?>
                                </td>
                				<td class="mandatory-field">*</td>
                			</tr>
                			<tr>
                				<td align="right"><label>County</label></td>
                				<td>
                                 <?php 
                                    if(!empty($address->user_default_listing_county)){
                                         echo CHtml::textField('Listingaddress[user_default_listing_county]',$address->user_default_listing_county,array('id'=>'county','class'=>'file_input_textbox', 'width'=>100,'maxlength'=>100));
                                    }else {
                                        echo $form->textField($address,'user_default_listing_county',array('size'=>60,'maxlength'=>200,'id'=>"county",'class'=>'file_input_textbox'));
                                    }                                  
                                    echo $form->error($address,'user_default_listing_county'); 
                                ?>
                                </td>
                				<td class="mandatory-field">*</td>
                			</tr>
                			<tr>
                				<td align="right"><label>Zip Code</label></td>
                				<td>
                                <?php 
                                    if(!empty($address->user_default_listing_zip_code)){
                                         echo CHtml::textField('Listingaddress[user_default_listing_zip_code]',$address->user_default_listing_zip_code,array('id'=>'zip_code','class'=>'file_input_textbox', 'width'=>100,'maxlength'=>100));
                                    }else {
                                        echo $form->textField($address,'user_default_listing_zip_code',array('size'=>50,'maxlength'=>50,'id'=>'zip_code','class'=>'file_input_textbox'));
                                    }                                  
                                    echo $form->error($address,'user_default_listing_zip_code'); 
                                ?>  
                                </td>
                				<td class="mandatory-field">*</td>
                			</tr>
                			<tr>
                				<td align="right"><label>Country</label></td>
                				<td colspan="2"><label>
                                <?php    
                                 $userModel = User::model()->findByAttributes(array("user_default_id"=>Yii::app()->user->getId()));                                                  
                                 $Country = Country::model()->findByAttributes(array('user_default_country_id'=>$userModel->user_default_country));
                                 echo $Country->user_default_country_name;
                                 echo CHtml::hiddenField('Listingaddress[user_default_listing_country]',$userModel->user_default_country,array('size'=>60,'maxlength'=>100)) 
                                 ?>
                				</label></td>
                			</tr>
                			<tr>
                				<td align="right"><label>Tel No.</label></td>
                				<td>
                                <?php 
                                    if(!empty($address->user_default_listing_tel)){
                                         echo CHtml::textField('Listingaddress[user_default_listing_tel]',$address->user_default_listing_tel,array('id'=>'tel_no','class'=>'file_input_textbox', 'width'=>100,'maxlength'=>30));
                                    }else {
                                        echo $form->textField($address,'user_default_listing_tel',array('size'=>30,'maxlength'=>30,'id'=>'tel_no','class'=>'file_input_textbox'));
                                    }                                  
                                    echo $form->error($address,'user_default_listing_tel'); 
                                ?>                                
                                </td>
                				<td class="mandatory-field">*</td>
                			</tr>
                					<tr>
                				<td></td>
                				<td align="center">
                				    
                                    <?php 
                                    if($model->isNewRecord){
                                    ?>
                                       <input type="submit" name="submit_user_listing_step1" id="submit" class="button button1 black" value="Insert" /> 	
                                       
                                    <?php    
                                    }else {
                                    ?>
                					 <input type="submit" name="update_user_listing_step1" id="submit" class="button button1 black" value="Update" /> 	
                				    <?php 
                                    }
                                    ?> 
                					
                				</td>
                				<td></td>
                			</tr>                          	
                			</table>
                              <?php $this->endWidget(); ?>		
                			
                        </div>
                         <div style="clear:both; height:20px;"></div>
                		<div>
                			<?php
$nree=$model->user_default_listing_id;
if($nree!="")
{
?>
                			<div class="steps">
                				<a class="active" style="cursor: default;">1</a> 
                               <a href="<?php echo Yii::app()->createUrl('listing/user_listing_step2/listid/'.$model->user_default_listing_id);?>">2</a> 
                                <a href="<?php echo Yii::app()->createUrl('listing/user_listing_step3/listid/'.$model->user_default_listing_id);?>">3</a> 
                        <a href="<?php echo Yii::app()->createUrl('listing/user_listing_step4/listid/'.$model->user_default_listing_id);?>">4</a>
                			</div>
<?php
}
else
{
?>
                			<div class="steps">
                				<a class="active" style="cursor: default;">1</a> 
                                <a href="javascript:void(0);" id="page2" >2</a> 
                                <a href="javascript:void(0);" id="page3">3</a> 
                                <a href="javascript:void(0);" id="page4">4</a>
                			</div>
<?php
}
?>
                			<div class="steps"><a href="javascript:void(0);" id="next" >next >></a></div>
                		</div>
                </div>
        </div>
</div>

<script type="text/javascript"><!--
    // Advert Carousel
	      
      //form validations
	function form_validation(frm){
		var failedvalidation = false;		  
		/** @check address1 empty or not */
		var company_name = JQ1('#company_name').val();
		if(company_name == ""){                
			JQ1("#company_name").addClass('mandatoryerror');
			JQ1("#company_name").attr('placeholder','Enter Company Name');             
			failedvalidation = true;            
		}else{
			JQ1("#company_name").removeClass('mandatoryerror');
			JQ1("#company_name").attr('placeholder','');
		}
		
		var address1 = JQ1('#address1').val();
		if(address1 == ""){                
			JQ1("#address1").addClass('mandatoryerror');
			JQ1("#address1").attr('placeholder','Enter your address');             
			failedvalidation = true;            
		}else{
			JQ1("#address1").removeClass('mandatoryerror');
			JQ1("#address1").attr('placeholder','');
		}
		/** @check town empty or not */
		var town = JQ1('#town').val();
		if(town == ""){                
			JQ1("#town").addClass('mandatoryerror');
			JQ1("#town").attr('placeholder','Add your town');             
			failedvalidation = true;            
		}else{
			JQ1("#town").removeClass('mandatoryerror');			
			JQ1("#town").attr('placeholder','');
		}
		/** @check county empty or not */
		var county = JQ1('#county').val();
		if(county == ""){                
			JQ1("#county").addClass('mandatoryerror');
			JQ1("#county").attr('placeholder','Enter your country');             
			failedvalidation = true;            
		}else{
			JQ1("#county").removeClass('mandatoryerror');
			JQ1("#county").attr('placeholder','');
		}
		/** @check zip_code empty or not */
		var zip_code = JQ1('#zip_code').val();
		if(zip_code == ""){                
			JQ1("#zip_code").addClass('mandatoryerror');
			JQ1("#zip_code").attr('placeholder','Enter zip code');             
			failedvalidation = true;            
		}else{
			JQ1("#zip_code").removeClass('mandatoryerror');
			JQ1("#zip_code").attr('placeholder','');
		}
		/** @check tel_no empty or not */
		var tel_no = JQ1('#tel_no').val();
		if(tel_no == ""){                
			JQ1("#tel_no").addClass('mandatoryerror');
			JQ1("#tel_no").attr('placeholder','Enter telephone number');             
			failedvalidation = true;            
		}else{
			JQ1("#tel_no").removeClass('mandatoryerror');
			JQ1("#tel_no").attr('placeholder','');
		}
        
        
        /* if (!preg_match('/^[0-9 ]{7,}$/',JQ1("#tel_no").val())) {            
            JQ1("#tel_no").val('');
            JQ1("#tel_no").addClass('mandatoryerror');
			JQ1("#tel_no").attr('placeholder','Enter valid telephone number');             
			failedvalidation = true;  
        } */
        
        if (checkInternationalPhone(JQ1("#tel_no").val())==false) {            
            JQ1("#tel_no").val('');
            JQ1("#tel_no").addClass('mandatoryerror');
			JQ1("#tel_no").attr('placeholder','Enter valid telephone number');             
			failedvalidation = true;  
        }
        //if(!JQ1.isNumeric(tel_no)){
        /* if(validatPhone(tel_no)){    
            JQ1("#tel_no").val('');
            JQ1("#tel_no").addClass('mandatoryerror');
			JQ1("#tel_no").attr('placeholder','Enter valid telephone number');             
			failedvalidation = true;     
        }*/
        
		if (failedvalidation){
			JQ1('#submit_user_listing_step1').val(0);
            return false;
		}else{
			JQ1("#userlisting-form").submit(); 
            //jQuery('#submit_user_listing_step1').val(1);
            
		}	
	}	
	
	
    var JQ1 =jQuery.noConflict(); 
    JQ1(document).ready(function() {
        JQ1('#add-carousel-wrap').jcarousel({
            wrap: 'circular',
            scroll: 1
        });
        JQ1("#page2 , #page3 , #page4 , #next").on("click",function(){
           JQ1(".button1").trigger("click");  
        });
        JQ1(".pu-close1").live("click",function(){
            JQ1(".photo-upload-boxs").addClass("hiddenbox");
            JQ1(".confirm").show();
        });            
        close_form();        
    });
    function close_form()
    {   JQ1(".photo-upload-boxs").removeClass("hiddenbox");
        JQ1(".confirm").hide();
    }
    
    function saveforlater()
    {
        document.getElementById("btnsaveforlater").value=1;
        document.getElementById("userlisting-form").submit();       
    }
    
    function checkInternationalPhone(strPhone1){
	   var bracket=4
       var minDigitsInIPhoneNumber = 10;
       var digits = "0123456789";
        var phoneNumberDelimiters = "()-+ ";        
        var validWorldPhoneChars = phoneNumberDelimiters + "+";
       
    	var strPhone=JQ1.trim(strPhone1)
    	if(strPhone.indexOf("+")>1) return false
    	if(strPhone.indexOf("-")!=-1)bracket=bracket+1
    	if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false
    	var brchr=strPhone.indexOf("(")
    	if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")return false
    	if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false
    	s=stripCharsInBag(strPhone,validWorldPhoneChars);
    	return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
    }  
    function isInteger(s)
    {   var i;
        for (i = 0; i < s.length; i++)
        {   
            // Check that current character is number.
            var c = s.charAt(i);
            if (((c < "0") || (c > "9"))) return false;
        }
        // All characters are numbers.
        return true;
    }
    function trim(s)
    {   var i;
        var returnString = "";
        // Search through string's characters one by one.
        // If character is not a whitespace, append to returnString.
        for (i = 0; i < s.length; i++)
        {   
            // Check that current character isn't whitespace.
            var c = s.charAt(i);
            if (c != " ") returnString += c;
        }
        return returnString;
    }
    function stripCharsInBag(s, bag)
    {   var i;
        var returnString = "";
        // Search through string's characters one by one.
        // If character is not in bag, append to returnString.
        for (i = 0; i < s.length; i++)
        {   
            // Check that current character isn't whitespace.
            var c = s.charAt(i);
            if (bag.indexOf(c) == -1) returnString += c;
        }
        return returnString;
    }

  //--></script>


