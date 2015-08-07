<?php
/* @var $this PrizeController */
/* @var $model PrizeDraw */
/* @var $form CActiveForm */

$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');
$js->registerScriptFile($baseUrl . '/js/jwplayer/jwplayer.js');
$js->registerScriptFile($baseUrl . '/js/tinymce.min.js');


$year=date('Y');
$month=date('m');
$connection = Yii::app()->db;
$command = $connection->createCommand("select * from `drg_price_draw` where `year`='$year' and month='$month'");
$myresult = $command->queryRow();


$this->breadcrumbs=array(
	'Edit Prize Draws Winner',
);

?>
<script type="text/javascript">
jQuery(document).ready(function(){
    
    jQuery(".chzn-select").chosen();
});
//jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
</script>

<style>
#win_username_chzn {
  top: 8px;
}
</style>
  <style type="text/css">#div_upload_big{height: auto !important;} #upload-frame { margin-left: 228px !important;} .qq-uploader .qq-upload-button.black.button {
  position: absolute !important;top: 20px; } .chzn-container{top: 7px; }</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tooltips.css" />  
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/adminstyle.css" />

        <br />

	
<div class="user_listing_search">

<a class="pu-close pu-close1" href="<?php echo Yii::app()->createUrl('/admin/prize/prize'); ?>" title="Close" style="margin-right: 0px;">X</a>

<div id="details" class="showhide">

    <div class="form">
	 <?php $form = $this->beginWidget('CActiveForm', array('id'=>'prize-form','enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>	
       
        <h2>Edit Winner details</h2>
        <br />
        <div style='margin-left: 15px;'>
            <label title="Date of draw">Draw date:</label>
			 <?php echo $form->textField($model, 'date_draw', array('class' => 'inp width-500', 'id' => 'date_draw', 'style'=>'width:80px','onfocus' => "getNormal('#date_draw');")); ?>

            <label title="Winners username">Username:</label>
<?php
  $listingpages = CHtml::listData(User::model()->findAll(array('order'=>"`drg_name` ASC")), 'drg_id', 'drg_name');
                        echo $form->dropDownList($model, 'user_id', $listingpages, array('class' => 'chzn-select', 'data-placeholder' => 'Please select', 'onfocus' => 'getSelectNormal("#user_id");', 'id' => 'user_id'));
           
?>

            <label title="Prize value">Amount won:</label>
			<?php echo $form->textField($model, 'prize_won_amount', array('class' => 'inp width-500', 'id' => 'prize_won_amount', 'style'=>'width:80px','onfocus' => "getNormal('#prize_won_amount');")); ?>
            <label title="Prize Paid Date">Paid Date:</label>
			<?php echo $form->textField($model, 'amount_paid_date', array('class' => 'inp width-500', 'id' => 'amount_paid_date', 'style'=>'width:80px','onfocus' => "getNormal('#amount_paid_date');")); ?>
            
			<label title="Payment ref">Payment Ref:</label>
			<?php echo $form->textField($model, 'payment_ref', array('class' => 'inp width-500', 'id' => 'payment_ref', 'style'=>'width:80px','onfocus' => "getNormal('#payment_ref');")); ?>
            </div>
        <br />
        <br />
<div class="sl-bottom-buttons admin-button">
            <input type="submit" value="Update" class="button blue" style="padding: 9px 15px;" name="winner_gallery" id="winner_gallery"/>
			
			 <a href="<?php echo Yii::app()->createUrl('/admin/prize/prize/ldelete/id/'.$model->id ); ?>" class="button red">Delete</a>
			 
			 <a href="<?php echo Yii::app()->createUrl('/admin/prize/prize'); ?>" class="button black">Cancel</a>
   		
			 
			 
<?php $this->endWidget(); ?>
        </div>
		</div></div></div>