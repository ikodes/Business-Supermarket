<p class="breadcrumb">
        <a href="index.php" >Home</a> &gt; 
        <a href="<?php echo Yii::app()->createUrl('/user/myaccount/update');?>"> my profile</a> &gt; 
        create user listing - step 2 of 4
    </p>
    <div class="clear"></div>
        <div>
            <?php 
            //$this->renderPartial('//layouts/listing_slider');
            $this->renderPartial('//../modules/listing/views/layouts/listing_slider');   
                     
            ?>
            
        </div>
     <div style="clear:both;"></div>
<div class="registration-box"> 
            <!-- registration box start-->
                <div id="registration-tabs"> 
                    <a href="javascript:void(0);">Create a Listing</a>                
                    <div class="clear"></div>
                </div>  
                	
				<div class="registration-content" style="min-height:571px">  
                <a class="pu-close pu-close-step2 pu-close1" href="javascript:void(0);" title="Close">X</a>               
				<h2 align="center" class="Blue">Create a User listing</h2>
         		<div style="text-align:center"><i style="font-size:7pt; color:#999999">Tell us about your business idea</i></div>
                
                <!--Confirm close pop up-->        
                <div class="confirm" style="width: 98%; height: 95%; padding-top:30px; margin-top:-40px;">
                  <div class="u-email-box"> 
                  	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png" style="z-index:999999; position:relative; top:2px;" />
                    <div class="my-account-popup-box" style="margin-top:-38px !important"> 
                      <a title="Close" href="javaScript:void(0)" onclick="close_form()" class="pu-close">X</a>
                      <br />
                      <h2 class="Blue">Are you sure you want to leave this page?</h2>
                      <p>Your form data has not been saved  leaving the listing submission process now will result in any data you have submitted being lost.<br /> Please save your listing first.</p>              
                      <table align="center" width="100%">
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                      	<tr>              	
                      	<td align="center">  
                       
                            <input class="button black" title="Close and return to form" name="canle" type="button" value="Cancel"  onclick="jQuery('.confirm').hide('slow');"/>  
                            <input class="button black" onclick="saveforlater();" title="Save and close form" name="register" type="button" value="Save &#38; Close"  />
                            <input class="button black" title="Discard ALL data and close form" name="register" type="button" value="Discard"  onclick="window.location.href='<?php echo Yii::app()->createUrl('user/myaccount/update'); ?>'" />               
                        </td>
                      </tr>
                      </table>
                    </div>
                  </div>
                </div>
            <!-- end close--> 
            
                <?php $form=$this->beginWidget('CActiveForm', array('id'=>'user_listing_step2','enableAjaxValidation'=>false,'htmlOptions'=>array("onSubmit"=>'return form_validation();'))); ?>				
                <?php 
                     //echo $form->errorSummary($model);
                ?>    		    
				<!--<form action="" method="post" enctype="multipart/form-data" id="user_listing_step2"  onsubmit="return form_validation();">-->
                 <?php echo $form->hiddenField($model,'user_default_listing_id',array('size'=>60,'maxlength'=>100)) ?>
				 <?php echo $form->hiddenField($model,'user_default_listing_thumbnail',array('size'=>60,'maxlength'=>100)) ?>
                 <input type="hidden" name="btnsaveforlater" value="0" id="btnsaveforlater" />				 
                <div>
                      <label style="color:#A84793;">Listing type <a class="sl-tip tooltip" href="#;">?<span class="classic">Please select a listing type from each drop down menu to continue</span></a></label>                                    
				</div>
				    
				<div>
					<table class="sl-select" style="width: 742px; margin-top:10px;">
					<tr class="select-listing">
						<td>Category:</td>
						<td>
							<?php 
                                $listData =  CHtml::listData(Listingcategory::model()->findAll(array("order"=>'user_default_listing_category_sort_order asc')),'user_default_listing_category_id','user_default_listing_category_name');
                                echo CHtml::dropDownList('Userlisting[user_default_listing_category_id]',$model->user_default_listing_category_id,$listData,array('empty' => 'Please select','class'=>'chzn-select','data-placeholder'=>'Please select','onfocus'=>'getSelectNormal("#sl_category");','id'=>'sl_category','tabindex'=>'1','title'=>'Select a category from the drop down menu'));
                                echo $form->error($model,'user_default_listing_category_id');                             
                            ?>
                           
						</td>
					  	<td class="sl-select-space"></td>
					  	<td>Looking For:</td>
					  	<td>                            
                            <?php 
                                $listData =  CHtml::listData(Listinglookingfor::model()->findAll(array("order"=>'user_default_listing_lookingfor_sort_order asc')),'user_default_listing_lookingfor_id','user_default_listing_lookingfor_name');
                                echo CHtml::dropDownList('Userlisting[user_default_listing_lookingfor_id]',$model->user_default_listing_lookingfor_id,$listData,array('empty' => 'Please select','class'=>'chzn-select','data-placeholder'=>'Please select','onfocus'=>'getSelectNormal("#sl_profession");','id'=>'sl_profession','tabindex'=>'2','title'=>'Select a what you are looking for from the list'));
                                echo $form->error($model,'user_default_listing_lookingfor_id');  
                            ?> 
						</td>
					  	<td class="sl-select-space"></td>
					 	<td>Limit viewing to:</td>
					  	<td>
                            <?php 
                                /*$listData =  CHtml::listData(Viewlimit::model()->findAll(array("order"=>'sort_order asc')),'limit_view_id','limit_view');*/
								$listData = CHtml::listData(Country::model()->findAll(),'user_default_country_id','user_default_country_name');
                                echo CHtml::dropDownList('Userlisting[user_default_listing_limit_viewing_id]',$model->user_default_listing_limit_viewing_id,$listData,array('empty' => 'Worldwide (default)','class'=>'chzn-select','data-placeholder'=>'Worldwide (default)','onfocus'=>'getSelectNormal("#sl_vlimit");','id'=>'sl_vlimit','tabindex'=>'3','title'=>'Limit your exposure of your business idea to a country of your choice'));
                                echo $form->error($model,'user_default_listing_limit_viewing_id'); 
                            ?>  
						</td>
					</tr>
					</table>
				</div>
				<div style="clear:both; height:20px;"></div>
				<div class="sl-photo-box" style="margin-left:0px; text-align:center">
					<p style="margin:0 0 0 16px;">Thumbnail / Logo</p>
					<i style="font-size:7pt; color:#999999; margin-left:12px;">Upload a small thumbnail or your logo</i>
					<div class="clear"></div>
					<br />
					<div class="photo-upload-box1 listing-upload" style="margin-top:-150px; height: 94%;">
						<img class="side-robot-upload1" src="<?php echo Yii::app()->theme->baseUrl;?>/images/robot/robot-upload.png" alt="Upload your Business Supermarket user profile picture"/>
						<div class="my-account-popup-box" id="upload-frame"> 
							<a class="pu-close" onclick=jQuery(".photo-upload-box1").hide(); href="javaScript:void(0)" title="Close">X</a>
							<h2>Upload thumbnail or logo</h2>
							Click <b>Upload Picture...</b> to choose an image from your computer<br />
                                                        Select an image that is 800px by 600px for best fit <br />
                                                        Your image will be automatically uploaded.<br />
                                                        <br />
                            
							<!--<iframe src="photo-upload/logo_listing.php" frameborder="0" width="390" height="310" id="pic_frame"></iframe>--> 
                            <div id="wrap">    
                                <div id="uploader">
                                    <div id="big_uploader">
                                    <div id="notice"></div>
                            		<i>Upload image maximum of 100KB.</i>
                                    <br/><br/>
                                    <div id="div_upload_big" class="listing_logo"></div>
                            		<div id="div_upload_big_new"></div>
                                    Browse for a picture on your computer
                                    <br />
                                    <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                        array(
                                                'id'=>'uploadFile',
                                                'config'=>array(
                                                       'action'=>Yii::app()->createUrl('listing/imageupload'),
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
					<div class="sl-photograph">
						<p style="color:#808080;" id="showImg">                        
                        <?php
                         
                            if(!empty($model->user_default_listing_thumbnail)) 
							{ 
							       $img_src = '/upload/users/'.Yii::app()->user->getState('ufolder').'/listing/big/'.$model->user_default_listing_thumbnail;
							?>
								<img src="<?php echo $img_src; ?>" style="width: 186px !important;height: 120px !important;" />
								<?php 
							}
							else if(!empty($_SESSION['logo_listing'])) 
							{ 
								?>
								<img src="<?php echo $_SESSION['logo_listing']; ?>" style="width: 186px !important;height: 120px !important;"/>
								<?php 
							} 
							else 
							{  
								?>
								<br />Image dimensions <br> must not exceed a <br> standard 6 x 4 photo <br /> 
                                        (400 x 600 pixels max) <br /> 
                                        &amp; must not exceed 2MB in size.
								<?php 
		                    } 
							?>
					   </p>
					</div>
					<!-- File Upload for Company Logo -->
					<div style="margin-top:10px;">
						<a class="button gray" title="Upload logo" onClick="show_picture_form1()" href="javaScript:void(0)"> &nbsp; Select Image &nbsp;</a>
						<input type="hidden" name="user_default_listing_thumbnail" id="drg_listing_logo" value="<?php echo $model->user_default_listing_thumbnail; ?>"/>
					</div>
					<!-- File Upload for Company Logo -->
				</div>
				<div class="sl-basic-info" style="width:518px;">
					<label>Title <a href="#;" class="sl-tip tooltip">?<span class="classic">Give your business idea a title</span></a></label>
					<br>
					<?php  
                         echo $form->textField($model,'user_default_listing_title',array('id'=>'drg_list_title','tabindex'=>'4' , 'size'=>50,'class'=>'inp width-500', 'maxlength'=>40,'onfocus'=>"getNormal('#drg_list_title');",)); 
                         echo $form->error($model,'user_default_listing_title'); 
                    ?> 
                    <br>
					<label>What is it?<a href="#;" class="sl-tip tooltip">?<span class="classic">In one sentence explain your business idea, for example:-<br><em style="font-size:0.9em; color:#A84793">'A security device to prevent fuel theft from gas stations'.</em></span></a></label>
					<br>
					
                    <?php  
                         echo $form->textField($model,'user_default_listing_what_is_it',array('id'=>'drg_list_what','tabindex'=>'5' , 'size'=>50,'class'=>'inp width-500', 'maxlength'=>70,'onfocus'=>"getNormal('#drg_list_what');",)); 
                         echo $form->error($model,'user_default_listing_what_is_it'); 
                    ?> 
                    
                    <br>
					<label>Enter a short explanation of what does it do or what problem does it solve.<a href="#;" class="sl-tip tooltip">?<span class="classic">Enter a short explanation of your business idea or product in 1 to 2 sentences for example:-<br><em style="font-size:0.9em; color:#A84793">'A security system that uses patent protected stinger system to immobilise any vehicle by using a controlled deflation of the rear wheels.<br> The offending vehicle will come to rest at a known distance  from the point of theft.'.</em></span></a></label>
				    <?php  
                        
                         echo $form->textArea($model,'user_default_listing_summary',array('id'=>'drg_list_explanation','tabindex'=>'6' ,'style'=>'height:70px;' ,'class'=>'width-500', 'maxlength'=>270, 'onfocus'=>"getNormal('#drg_list_explanation');",)); 
                         echo $form->error($model,'user_default_listing_summary'); 
                     ?> 
                
                </div>
				<div class="sl-basic-info">
					<label>Enter details of your business idea / activities.<a href="#;" class="sl-tip tooltip">?<span class="classic">Use this space to detail your business.<br>
						How did you come up with the idea?<br>
						Why do you feel there is a need?<br>
						Do you have any marketing data?<br>
					</span></a></label>
				    <?php  
                        
                         echo $form->textArea($model,'user_default_listing_details',array('id'=>'drg_list_businessidea','tabindex'=>'7' ,'style'=>'height:100px;' ,'class'=>'textarea-full','onfocus'=>"getNormal('#drg_list_businessidea');",)); 
                         echo $form->error($model,'user_default_listing_details'); 
                     ?> 
                
                </div>
				<div class="sl-basic-info">
					<label>Financial projections. <a href="#;" class="sl-tip tooltip">?<span class="classic">If you have been trading then detail any financial data that you may have in the table below.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 10K = 10,000<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 10M =10,000,000</span></a></label>
					<br/>
					<div class="text_content grey">please select one option if you do not have financial data</div>
					
					<div class="financial">
							<?php 
                            $disabled='';
                            $insert = true;
                            $checkvalidate=true;  
                            $financial_data = Data::model()->findByPk('2'); 
                            $financial_data1 = CJSON::decode($financial_data->data);
                            foreach($financial_data1 as $key => $value)
							{
								$sel='';
								if($model->user_default_listing_financial_table_status==$key){
									
                                    $insert = false;
                                    $sel='checked="checked"';
                                    $disabled='disabled="disabled" style="background:#f0f0f0;"';
                                    $checkvalidate=false;
								}
							?> 
							<div>
                                <div class="flow_left mrgn_right">
                                    <input <?php echo $sel;?> type="radio" name="user_default_listing_financial_table_status"  class="currency financial_data" value="<?php echo $key;?>"/>
                                </div>
                                <div><?php echo $value;?></div>
                            </div>
							<?php
							}  
                            ?>
                            
                            
						<br class="clear"/>
					</div>
					<div class="text_content grey"> or if you have financial data then complete the table below and select your currency </div>
					
					<table class="sl-select no_financeData" style="width: 730px; left: -5px;">	
                    <?php 
                    $years = explode(',',$model->user_default_listing_fprojections);                    
                    ?>					
					<tr>
						<td>Year 1<input <?php echo $disabled;?> onkeyup="format(this)" maxlength="10" onfocus="getNormal('#drf_list_year1');" type="text" name="user_default_listing_fprojections[]" id="drf_list_year1" class="inp price1 width-105" value="<?php echo $years[0];?>"/></td>
						<td>Year 2<input  <?php echo $disabled;?> onkeyup="format(this)" maxlength="10" onfocus="getNormal('#drf_list_year2');" type="text" name="user_default_listing_fprojections[]" id="drf_list_year2" class="inp price1 width-105" value="<?php echo $years[1];?>"/></td>
						<td>Present<input <?php echo $disabled;?> onkeyup="format(this)" maxlength="10" onfocus="getNormal('#drf_list_yearpresent');" type="text" name="user_default_listing_fprojections[]" id="drf_list_yearpresent" class="inp price1 width-105" value="<?php echo $years[2];?>"/></td>
						<td>Year 1<input  <?php echo $disabled;?> onkeyup="format(this)" maxlength="10" onfocus="getNormal('#drf_list_years1');" type="text" name="user_default_listing_fprojections[]" id="drf_list_years1" class="inp price1 width-105" value="<?php echo $years[3];?>"/></td>
						<td>Year 2<input <?php echo $disabled;?> onkeyup="format(this)" maxlength="10" onfocus="getNormal('#drf_list_years2');" type="text" name="user_default_listing_fprojections[]" id="drf_list_years2" class="inp price1 width-105" value="<?php echo $years[4];?>"/></td>
						<td>Year 3<input <?php echo $disabled;?> onkeyup="format(this)" maxlength="10" onfocus="getNormal('#drf_list_years3');" type="text" name="user_default_listing_fprojections[]" id="drf_list_years3" class="inp price1 width-105" value="<?php echo $years[5];?>"/></td>
					</tr>
					</table>
					<table class="no_financeData" style="margin-bottom:24px; ">
					 
				    <!--
					<tr>
						<td width="100%" valign="top" colspan="3">
							<input type="checkbox" value="1" name="drg_favailable" id="drg_favailable" onClick="enableDisable();" style="margin-left:30px;"/> <label style="color:#000;">Financial data available.<a href="#;" class="sl-tip tooltip">?<span class="classic">If you have entered data in the  above table you MUST select this box AND the currency of your figures below </span></a></label>							
						</td>
					</tr>
					-->
					<tr>
						<td width="90%" valign="top" colspan="2">
							<label style="color:#000;">Amount is in:-</label>
						</td>
						<td width="10%">&nbsp;  </td>						
					</tr>
					<tr>
						<td colspan="2" width="100%" valign="top">
						<div class="amountselect"> 
                            <?php 
							$amount_data = Data::model()->findByPk('1'); 
                            $amount_data1 = CJSON::decode($amount_data->data);
							foreach($amount_data1 as $key => $value)
							{
								$sel='';
								if($model->user_default_listing_table_currency_code==$key){
									$sel='checked="checked"';
                                    $insert = false;
								}
								?> 
								<div >
                                    <div class="flow_left mrgn_right">
                                        <input <?php echo $sel;?> type="radio" name="user_default_listing_table_currency_code" class="currency" value="<?php echo $key;?>"/>
                                    </div>
                                    <div class="flow_left"><?php echo $value;?></div>
                                </div>
								<?php
							}
							?>
						</div>	
						</td>
						
					</tr>
					</table>
					<div class="sl-basic-info">
						<label>Enter details of what you want.<a href="#;" class="sl-tip tooltip">?<span class="classic">Are you looking to sell your idea?<br>Are you looking for a partner or an investor?<br>Do you want to license your idea?<br></span></a></label>
						 <?php  
						 echo $form->error($model,'user_default_listing_want'); 
                         echo $form->textArea($model,'user_default_listing_want',array('id'=>'drg_list_detail' ,'class'=>'textarea-full','maxlength'=>500,'onfocus'=>"getNormal('#drg_list_detail');",)); 
                         
                         ?> 
                        <label>Enter keywords for our search engine.<a href="#;" class="sl-tip tooltip">?<span class="classic">
						Be specific in the choice of your keywords. <br>A few well chosen descriptive words give better response than a large block of text that could make it difficult for you to attract the right kind of interest.<br>Separate each word with a comma and a space.</span></a></label>
    					   <?php  
                             echo $form->textArea($model,'user_default_listing_keywords',array('id'=>'drg_list_keyword' ,'maxlength'=>255,'class'=>'textarea-full','onfocus'=>"getNormal('#drg_list_keyword');",)); 
                             echo $form->error($model,'user_default_listing_keywords'); 
                           ?> 
                    </div>
				</div>
				<div class="submit_button">
                                    <input type="button" name="saveforlater" id="savelater" class="button blue" value="Save for later" style="float:left; margin-left:144px; margin-top: 10px;" />                         
                        <?php                         
                        if($model->isNewRecord || $insert==true){
                        ?>
                            <input type="submit" name="submit_user_listing_step2" class="button green_button" value="Insert" style="float:right; margin-right:171px; margin-top: 10px;"  />
                        <?php 
                        }
                        else {
                        ?>
                            <input type="submit" name="update_user_listing_step2" class="button black" value="Update" style="float:right; margin-right:171px; margin-top: 10px;" />
                        <?php 
                         }
                        ?>
                     </div> 
				
                <?php 
                $this->endWidget();
                ?>
                <div style="clear:both; height:20px;"></div>
                <div class="navigation">
                    <div>
                        <a href="<?php echo Yii::app()->createUrl('listing/create/listid/'.$model->user_default_listing_id);?>">&lt;&lt; previous</a>
                    </div>
                    <div> 
                        <a href="<?php echo Yii::app()->createUrl('listing/create/listid/'.$model->user_default_listing_id);?>">1</a> 
                        <a class="active" style="cursor:default;">2</a> 
                        <a onclick="return formSubmit();" href="javascript:void(0);">3</a> 
                        <a  href="<?php echo Yii::app()->createUrl('listing/user_listing_step4/listid/'.$model->user_default_listing_id);?>">4</a>
                    </div>
                    <div>
                        <a onclick="return formSubmit();" href="javascript:void(0);">next &gt;&gt;</a>
                    </div>
                </div>
                <div style="clear:both; height:20px;"></div>
            </div>
            <div class="clear"></div>
        </div>
        <!--end bottom carousel----->   
<script type="text/javascript"><!--
 
  
 function formSubmit(){
    $("#user_listing_step2").submit();
 }
 
 function getUploadfilename(result){
    if(result.success){ 
        jQuery("#showImg").html('');
        var img = '<img style="width:186px;height:120px" src="<?php echo Yii::app()->getBaseUrl(true).'/upload/users/'.Yii::app()->user->getState('ufolder').'/listing/thumb/'; ?>' + result.filename + '"  />'
        jQuery("#drg_listing_logo").val(result.filename);
		jQuery("#Userlisting_user_default_listing_thumbnail").val(result.filename);
        jQuery("#showImg").html(img);
        jQuery(".photo-upload-box1").hide();
   }
 }
 
 
 
// Advert Carousel
    jQuery(document).ready(function() {
        jQuery('#add-carousel-wrap').jcarousel({
            wrap: 'circular',
            scroll: 1
        });
       	//jQuery('.amountselect input[name="user_default_listing_table_currency_code"]').trigger("click");  
           jQuery("#savelater").live("click",function(){
                jQuery(".pu-close1").trigger("click");
                jQuery('html, body').animate({scrollTop: '300px'}, 1000);
           });                                              
    });
    
// Chosen dropbox styling code           
$(".chzn-select").chosen();
$(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
//var checkForFinance = '<?php echo $checkvalidate;?>';
var checkForFinance = false;
$('.financial input').click(function(){
	if($('.amountselect input[name="user_default_listing_table_currency_code"]:checked').length){
		$('.amountselect input').prop('checked', false);                
	}
        checkForFinance = false;
        if($('.no_financeData input[type="text"]').hasClass('mandatoryerror')){
            $('.no_financeData input[type="text"]').removeClass('mandatoryerror');
        }
	$('.no_financeData input[type="text"]').attr({'disabled':'disabled','placeholder':''});
        $('.no_financeData input[type="text"]').css({'background':'#F0F0F0'});
});

$('.amountselect input').click(function(){
	if($('.financial input[name="user_default_listing_financial_table_status"]:checked').length){
		$('.financial input').prop('checked', false);		
	}
        checkForFinance = true;
	$('.no_financeData input[type="text"]').removeAttr('disabled');
        $('.no_financeData input[type="text"]').css({'background':'#F1E5E2'});
});
--></script>
<script type="text/javascript"><!--
function enableDisable()
{
	if($('#drg_favailable').is(":checked"))  
	{
		$(".currency").prop('disabled',false);
	}
	else
	{	
		$(".currency").prop('disabled',true);
	}
}
	
    function show_picture_form1(){
         jQuery(".photo-upload-box1").show();
    }

    
//form validations
function getNormal(id){
	$(id).attr('placeholder','');	
	if($(id).hasClass('mandatoryerror')){
	$(id).removeClass('mandatoryerror');
	}
}
function getSelectNormal(id){
	if($(id).hasClass('mandatoryerror')){
	$(id).removeClass('mandatoryerror');
	$(id).css('border-radius','0');
	}
}

function form_validation(frm){
        /*remove the error class for financial data*/
        $('.select_error').remove();
	var failedvalidation = false;
    //var regexPattern = /^\d{0,8}(\.\d{1,2})?$/;

	//var regexPattern = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/; 
    
    var regexPattern = /^[0-9.,\b]+$/;
    
   

    /**	@validation for listing category */
	var sl_category = $('#sl_category option:selected').val();
	if(sl_category == ""){
		$("#sl_category").siblings().addClass('mandatoryerror');
		$("#sl_category").siblings().css('border-radius','5px');
		var sibling_id = $("#sl_category").siblings().attr('id');
		$('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");
		failedvalidation = true;
	}else{
		$("#sl_category").siblings().removeClass('mandatoryerror');
		$("#sl_category").siblings().css('border-radius','0');
	}

	/**	@validation for listing profession */
	var sl_profession = $('#sl_profession option:selected').val();
	if(sl_profession == ""){
		$("#sl_profession").siblings().addClass('mandatoryerror');
		$("#sl_profession").siblings().css('border-radius','5px');
		var sibling_id = $("#sl_profession").siblings().attr('id');
		$('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");
		failedvalidation = true;
	}else{
		$("#sl_profession").siblings().removeClass('mandatoryerror');
		$("#sl_profession").siblings().css('border-radius','0');
	}

	/**	@validation for listing visibilty limit */
	/*var sl_vlimit = $('#sl_vlimit option:selected').val();
	if(sl_vlimit == ""){
		$("#sl_vlimit").siblings().addClass('mandatoryerror');
		$("#sl_vlimit").siblings().css('border-radius','5px');
		var sibling_id = $("#sl_vlimit").siblings().attr('id');
		$('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");
		failedvalidation = true;
	}else{
		$("#sl_vlimit").siblings().removeClass('mandatoryerror');
		$("#sl_vlimit").siblings().css('border-radius','0');
	}*/
    
    var Userlisting_user_default_listing_thumbnail = $('#Userlisting_user_default_listing_thumbnail').val()
    if(Userlisting_user_default_listing_thumbnail==""){
        $(".sl-photograph").addClass('mandatoryerror');
		$("#showImg").attr({'placeholder':'Please upload your logo'});
		failedvalidation = true;
    }else {
        $(".sl-photograph").removeClass('mandatoryerror');
        failedvalidation = false;
            
    }

	/**	@validation for listing title */
	var drg_list_title = $('#drg_list_title').val();
	if(drg_list_title == ""){
		$("#drg_list_title").addClass('mandatoryerror');
		$("#drg_list_title").attr({'placeholder':'Enter title for your business listing'});
		failedvalidation = true;
	}else{
		$("#drg_list_title").removeClass('mandatoryerror');
		$("#drg_list_title").attr({'placeholder':''});
	}

	/**	@validation for listing what is it */
	var drg_list_what = $('#drg_list_what').val();
	if(drg_list_what == ""){
		$("#drg_list_what").addClass('mandatoryerror');
		$("#drg_list_what").attr({'placeholder':'Please explain in one sentence what is your idea'});
		failedvalidation = true;
	}else{
		$("#drg_list_what").removeClass('mandatoryerror');
		$("#drg_list_what").attr({'placeholder':''});
	}

	/**	@validation for listing short explanation */
	var drg_list_explanation = $('#drg_list_explanation').val();
	if(drg_list_explanation == ""){
		$("#drg_list_explanation").addClass('mandatoryerror');
		$("#drg_list_explanation").attr({'placeholder':'Write a short explanation'});
		failedvalidation = true;
	}else{
		$("#drg_list_explanation").removeClass('mandatoryerror');
		$("#drg_list_explanation").attr({'placeholder':''});
	}

	/**	@validation for listing business idea/activity */
	var drg_list_businessidea = $('#drg_list_businessidea').val();
	if(drg_list_businessidea == ""){
		$("#drg_list_businessidea").addClass('mandatoryerror');
		$("#drg_list_businessidea").attr({'placeholder':' Enter business idea/activity'});
		failedvalidation = true;
	}else{
		$("#drg_list_businessidea").removeClass('mandatoryerror');
		$("#drg_list_businessidea").attr({'placeholder':''});
	}
        if(checkForFinance){
	/**	@validation for listing business Financial projections past year 1*/
	var drf_list_year1 = $('#drf_list_year1').val();
	if(drf_list_year1 == ""){
		$("#drf_list_year1").addClass('mandatoryerror');
		$("#drf_list_year1").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		$("#drf_list_year1").removeClass('mandatoryerror');
		$("#drf_list_year1").attr({'placeholder':''});
	}

    if(drf_list_year1 !="" && !regexPattern.test(drf_list_year1)){
       	$("#drf_list_year1").addClass('mandatoryerror');
		$("#drf_list_year1").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    }    


	/**	@validation for listing business Financial projections past year 2 */
	var drf_list_year2 = $('#drf_list_year2').val();
	if(drf_list_year2 == ""){
		$("#drf_list_year2").addClass('mandatoryerror');
		$("#drf_list_year2").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		$("#drf_list_year2").removeClass('mandatoryerror');
		$("#drf_list_year2").attr({'placeholder':''});
	}
    
    if(drf_list_year2 !="" && !regexPattern.test(drf_list_year2)){
       	$("#drf_list_year2").addClass('mandatoryerror');
		$("#drf_list_year2").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    } 
    
	/**	@validation for listing business Financial projections present year */
	var drf_list_yearpresent = $('#drf_list_yearpresent').val();
	if(drf_list_yearpresent == ""){
		$("#drf_list_yearpresent").addClass('mandatoryerror');
		$("#drf_list_yearpresent").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		$("#drf_list_yearpresent").removeClass('mandatoryerror');
		$("#drf_list_yearpresent").attr({'placeholder':''});
	}
    if(drf_list_yearpresent !="" && !regexPattern.test(drf_list_yearpresent)){
       	$("#drf_list_yearpresent").addClass('mandatoryerror');
		$("#drf_list_yearpresent").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    } 
    
	/**	@validation for listing business Financial projections future year 1*/
	var drf_list_years1 = $('#drf_list_years1').val();
	if(drf_list_years1 == ""){
		$("#drf_list_years1").addClass('mandatoryerror');
		$("#drf_list_years1").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		$("#drf_list_years1").removeClass('mandatoryerror');
		$("#drf_list_years1").attr({'placeholder':''});
	}
    if(drf_list_years1 !="" && !regexPattern.test(drf_list_years1)){
       	$("#drf_list_years1").addClass('mandatoryerror');
		$("#drf_list_years1").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    }
	/**	@validation for listing business Financial projections future year 2*/
	var drf_list_years2 = $('#drf_list_years2').val();
	if(drf_list_years2 == ""){
		$("#drf_list_years2").addClass('mandatoryerror');
		$("#drf_list_years2").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		$("#drf_list_years2").removeClass('mandatoryerror');
		$("#drf_list_years2").attr({'placeholder':''});
	}
    if(drf_list_years2 !="" && !regexPattern.test(drf_list_years2)){
       	$("#drf_list_years2").addClass('mandatoryerror');
		$("#drf_list_years2").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    }
	/**	@validation for listing business Financial projections future year 3*/
	var drf_list_years3 = $('#drf_list_years3').val();
	if(drf_list_years3 == ""){
		$("#drf_list_years3").addClass('mandatoryerror');
		$("#drf_list_years3").attr({'placeholder':' Enter amount'});
		failedvalidation = true;
	}else{
		$("#drf_list_years3").removeClass('mandatoryerror');
		$("#drf_list_years3").attr({'placeholder':''});
	}
    if(drf_list_years3 !="" && !regexPattern.test(drf_list_years3)){
       	$("#drf_list_years3").addClass('mandatoryerror');
		$("#drf_list_years3").attr({'placeholder':' Enter valid amount'});
		failedvalidation = true;
    }
    
    }
	/**	@validation for listing details of what you want*/
	var drg_list_detail = $('#drg_list_detail').val();
        
	if(drg_list_detail == ""){
		$("#drg_list_detail").addClass('mandatoryerror');
		$("#drg_list_detail").attr({'placeholder':' Enter details of what you want'});
		failedvalidation = true;
	}else{
		$("#drg_list_detail").removeClass('mandatoryerror');
		$("#drg_list_detail").attr({'placeholder':''});
	}

	/**	@validation for listing keywords for our search engine*/
	var drg_list_keyword = $('#drg_list_keyword').val();
	if(drg_list_keyword == ""){
		$("#drg_list_keyword").addClass('mandatoryerror');
		$("#drg_list_keyword").attr({'placeholder':' Enter keywords'});
		failedvalidation = true;
	}else{
		$("#drg_list_keyword").removeClass('mandatoryerror');
		$("#drg_list_keyword").attr({'placeholder':''});
	}
	
	if($('.amountselect input[name="user_default_listing_table_currency_code"]:checked').length==false && $('.financial input[name="user_default_listing_financial_table_status"]:checked').length==false){
		failedvalidation = true;
		$('.amountselect').before('<div class="select_error">Please select atleast one option either no financial data available or financial data available</div>');
	} 
        
	if (failedvalidation){		
                return false;
	}else {
	   //$("#user_listing_step2").submit();
	}
	setTimeout(function(){ 
		$(".select_error").hide();
	}, 10000);
}
    
    function format(input)
    {
        var nStr = input.value + '';
        nStr = nStr.replace( /\,/g, "");
        var x = nStr.split( '.' );
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while ( rgx.test(x1) ) {
            x1 = x1.replace( rgx, '$1' + ',' + '$2' );
        }
        input.value = x1 + x2;
    }
    
    jQuery(document).ready(function(){
       jQuery(".pu-close1").live("click",function(){
            jQuery(".confirm").show();
        })
        jQuery(".price1").trigger("keyup");    
        close_form(); 
    });
    
    function close_form()
    {   JQ1(".confirm").hide();
    }
    
    function saveforlater()
    {
        document.getElementById("btnsaveforlater").value=1;
        document.getElementById("user_listing_step2").submit();       
    }
//--></script>
<!-- /shadow-wrap -->
