 <?php
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'search-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                'method'=>'post',
                'action'=>Yii::app()->createUrl("search/")
            ));
            ?>
     <div id="search-tab">
		<input type="text"  value="<?php echo $_GET['serachKey']; ?>" name="serachKey" id="serachKey" placeholder="Search site...">
		<a href="<?php echo Yii::app()->baseUrl; ?>/search/" title='Search the site'>
			<input type="submit" value=""  id="searchbtn">
		</a> </div>  <?php $this->endWidget(); ?>