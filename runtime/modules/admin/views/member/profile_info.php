<div class="user_image_container">
 <?php 
 $user_dirname = strtolower($model->user_default_username).'_'.$model->user_default_id.'/images';
 //echo Yii::app()->basePath.'/../www/upload/users/'.$user_dirname.'/'.$model->user_default_profile_image;die;
 if($model->user_default_profile_image){
    if($model->user_default_type=='business' && file_exists(Yii::app()->basePath.'/../www/upload/logo/'.$model->user_default_profile_image))
           $img = $this->createUrl('/upload/logo/'.$model->user_default_profile_image);  
    elseif($model->user_default_type=='user' && file_exists(Yii::app()->basePath.'/../www/upload/users/'.$user_dirname.'/'.$model->user_default_profile_image))
          $img = $this->createUrl('/upload/users/'.$user_dirname.'/'.$model->user_default_profile_image);  
    else
        $img = $this->createUrl('/upload/logo/avatar.jpg');
$alt_img = $model->user_default_first_name.' '.$model->user_default_surname;            
 }else {
     $img = $this->createUrl('/upload/logo/avatar.jpg');
     $alt_img = 'Avatar';
 }
 ?>
 <img src="<?php echo $img;?>" alt="<?php echo $alt_img;?>" width="107px;" height="99px;" />
</div>
    
<!-- User profile script goes here -->

 <div class="user_info_container">
     <div style="float: right; width: 78%; margin:-9px -22px 0 0;">
         <ul>
             <li><label class="field">Member since:</label> <?php echo $model->user_default_registration_date;?></li>
             <li><label class="field">Member type:</label> <?php echo $model->user_default_type;?></li>
             <?php 
             $criteria = new CDbCriteria;
             $criteria->condition = "t.user_default_id = '".$model->user_default_id."' AND t.datetime > SUBTIME('".date('Y-m-d H:i:s')."', '00:30:00')";
             $criteria->order = "t.datetime DESC";
             $user_activity = ActivityLog::model()->find($criteria);
             if($user_activity && $user_activity->log_id != 14){
                if($user_activity->log_id == 12)
                    $status = 'Online but Idle';
                else
                    $status = 'Online';
             }
             else
                $status = 'Offline';
             ?>
             <li><label class="field">Status:</label> <?php echo $status; ?></li>
             <li><label class="field">Prize wins:</label> 1</li>
             <li><label class="field">Total won:</label> $200</li>
             <li><label class="field">Time logged this month:</label> 25 hrs</li>
             <li><label class="field">Average time logged per month:</label> 65 hrs</li>
             <li><label class="field">Points total this month:</label> 120</li>
         </ul>
     </div>
</div>  

<?php 
$prev_member = Member::prev_member($model->user_default_id);
$next_member = Member::next_member($model->user_default_id);
if($prev_member || $next_member)
{
?>

<div class="memberNavigation"> 
    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Record <?php echo Member::getRowPosition($model->user_default_id);?> of <?php echo $total;?></span><br>
    <?php if(is_object($prev_member)){  ?>
        <aside class="prevLink">
            <a href="<?php echo $this->createUrl('/admin/member/update/id/'.$prev_member->user_default_id);?>">&lsaquo;&lsaquo;Previous</a>    
        </aside>
    <?php } ?>

    <?php if(is_object($next_member)){ ?>
        <aside class="nextLink">
            <a href="<?php echo $this->createUrl('/admin/member/update/id/'.$next_member->user_default_id);?>">Next&rsaquo;&rsaquo;</a>    
        </aside>
    <?php } ?>
</div>
<?php
}
?>     
   
   <div class="clearBoth"></div>