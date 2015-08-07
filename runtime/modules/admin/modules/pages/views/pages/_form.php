<?php
$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');
$js->registerScriptFile($baseUrl . '/js/jwplayer/jwplayer.js');
$js->registerScriptFile($baseUrl . '/js/tinymce.min.js');


?>
   <?php 
   Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jwplayer1/jwplayer.js',CClientScript::POS_END);   
   ?> 
   <script type="text/javascript">jwplayer.key="2SjjlzyKCa+5G6RGoZhN/hLyW2KiOB0xz/7EcQ==";</script>  
  <style type="text/css">#div_upload_big{height: auto !important;} #upload-frame { margin-left: 228px !important;} .qq-uploader .qq-upload-button.black.button {
  position: absolute !important;top: 20px; } .chzn-container{top: 7px; }</style>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".chzn-select").chosen();
        jQuery("#registration-tabs a").live("click",function(){
            jQuery("#registration-tabs a").removeClass("active");
            jQuery(this).addClass("active");  
            jQuery(".showhide").hide();
            /*var activediv =  jQuery(this).attr("data-active") ;
            jQuery(this).addClass("active");*/
            jQuery("#"+jQuery(this).attr("data-active")).show();
        });
    });


//jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
</script>
<?php
/* @var $this SliderController */
/* @var $model Slider */
/* @var $form CActiveForm */
?>
<style>
  .sl-photograph img {
height : 141px;
}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tooltips.css" />  
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/adminstyle.css" />


<div class="user_listing_search">

<a class="pu-close pu-close1" href="<?php echo Yii::app()->createUrl('/admin/pages/pages'); ?>" title="Close" style="margin-right: 0px;">X</a>

<div id="details" class="showhide">

    <div class="form">

                <?php $form = $this->beginWidget('CActiveForm', array('id'=>'pages-form','enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>	
       

        <div>
		<h2 align="center" class="Blue" style="margin:15px 0;"><?php
  if($model->isNewRecord)
  {
  echo "Create a new page";
  }
  else 
  { 
  echo "Edit page";
  } ?></h2>
  
  <?php  $page =  Pages::model()->findByPk($model->id);    $pslug = $page->pslug;  /*
   $connection = Yii::app()->db;     $mid=$model->id;
$command = $connection->createCommand("select * from `drg_site_actions` where `id`='$mid'");
$myresult = $command->queryRow();
$pslug= $myresult['pslug']; */
if($pslug!="")
{
$slug=explode("/",$pslug);
}
?>
		<div class="sl-basic-info pro-field" style="  width: 973px; margin-left:2px;  text-align: center;">
            <label>Page Title <a class="sl-tip tooltip" href="#;">?<span class="classic">Give your page a title</span></a></label>                                
            
            <?php echo $form->textField($model, 'pname', array('class' => 'inp width-500', 'id' => 'slider_title', 'style'=>'width:450px','onfocus' => "getNormal('#slider_title');")); ?>
</div>

	<div class="sl-basic-info pro-field" style="  width: 939px;  margin-left: 0px;  text-align: center;">
            <label>Controller Name <a class="sl-tip tooltip" href="#;">?<span class="classic">Give controller name of the page</span></a></label>                                
            
            <input type="text" required="" name="controller" id="controller" class="inp width-500" style="width:450px" value="<?php echo $slug[0]; ?>" />
			
			</div>
			
				<div class="sl-basic-info pro-field" style="  width: 959px;text-align: center;">
            <label>Action Name <a class="sl-tip tooltip" href="#;">?<span class="classic">Give action name of the page</span></a></label>                                
            
            <input type="text" required="" name="action" id="action" class="inp width-500" style="width:450px" value="<?php echo $slug[1]; ?>" />
			
			</div>
    

    
        <div class="sl-bottom-buttons admin-button">
 
  <?php
  if($model->isNewRecord)
  {
  ?>
    <button type="submit" class="button blue">Create</button>
  <?php
  }
  else
  {
  ?>     <button type="submit" class="button blue" style="margin: 0 80px;">Update</button>
  
       <a href="<?php echo Yii::app()->createUrl('/admin/pages/pages/ldelete/id/'.$model->id ); ?>" class="button red">Delete</a>
                
					 <?php
					 }
					 ?>
        <a href="<?php echo Yii::app()->createUrl('/admin/pages/pages'); ?>" class="button black">Cancel</a>
   		<div class="clear"></div>
        </div>

 

<?php $this->endWidget(); ?>
	


    </div><!-- form -->
</div>
  </div>
	
</div>

<script type="text/javascript"><!--
jQuery(document).ready(function(){
       jQuery(".pu-close1").live("click",function(){
            jQuery(".confirm").show();
        })            
        close_form(); 
    });    
    function close_form()
    {   JQ1(".confirm").hide();
    }
    
 
 function getUploadfilename(result,id){
    if(result.success){ 
        jQuery("#image_preview"+id).html('');
        var img = '<img src="<?php echo Yii::app()->baseUrl.'/upload/sliders/thumb/'; ?>' + result.filename + '" />'
        jQuery("#logo_"+id).val(result.filename);
        jQuery("#image_preview"+id).html(img);
        jQuery(".photo-upload-box"+id).hide();
   }
 }   

    
function show_picture_form(openTabId){
    jQuery("."+openTabId).show();
   openTabId = openTabId.replace('video-upload-box','');
    jQuery('#pic_frame_'+openTabId).attr({'src':'video-upload/step_1.php?id='+openTabId });
}
 
 jQuery('#pages-form').submit(function(event){
 
	var noImage = [];
	var hasImageButText = [];
 if(jQuery('#slider_title').val()=='')
 {
 alert('Please Enter Page Title');
 event.preventDefault();
 }


		 
 });

/*jQuery('#slider-form').submit(function(event){

	var failedvalidation = false;

	for(var i=1;i<=5;i++){            
	
		if(jQuery('#image-description-'+i).val()=='' || jQuery('#image-description-'+i).val()=='Please enter image description'){
		   noImage.push(true);  
	
		if( jQuery('#logo_'+i).val()!='' && (jQuery('#image-description-'+i).val()=='' || jQuery('#image-description-'+i).val()=='Please enter image description')){
			hasImageButText.push(true);
			onText.push(i);
		 }
		 
		 
		 if( jQuery('#logo_'+i).val()=='' && ( jQuery('#image-description-'+i).val()!='' && jQuery('#image-description-'+i).val()!='Please enter image description') ){
			hasTextButImage.push(true);
			onImage.push(i);
		 }
	}

		
	if (failedvalidation){		
		event.preventDefault();
	}
	
});*/

//--></script>  
 