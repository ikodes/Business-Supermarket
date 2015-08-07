<p class="breadcrumb">
        <a href="index.php" >Home</a> &gt; 
        <a href="<?php echo Yii::app()->createUrl('/user/myaccount/update');?>"> my profile</a> &gt; 
        create user listing - step 1 of 4
    </p> <?php
 
 echo $this->renderPartial('_form', array(    'model' => $model));
 
 ?> 