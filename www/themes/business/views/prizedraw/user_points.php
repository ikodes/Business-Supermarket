<?php
$user_default_id = Yii::app()->user->id;
			
if($user_default_id!="")
{
$this->breadcrumbs=array(
	'User Points',
);
$connection = Yii::app()->db;

$userdetails1 = $connection->createCommand("select * from `user_default_prize_draw` ");
$result = $userdetails1->queryAll();


?>
    

    <!-- /main-content -->

    <div class="clear"></div>

    <div class="registration-box">

        <div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>

            <div class="clear"></div>

        </div> 

        <div class="registration-content" style="  min-height: 610px;">

            <div class="my-account-links">

              <?php 

                $this->renderPartial("//layouts/my-account-links"); 

              ?>

            </div>
<div class="prize-draw-box" style="border:none"> 
<table width="84%" align="center" border="1" cellpadding="2" cellspacing="0">
<tr>
<th>SrNo </th>
<th>Name /User Name </th>
<th>Month</th>
<th>Points</th>
</tr>
<?php
$srno=1;
foreach($result as $row)
{
$month=$row['month'];
$year=$row['year'];
$datestr=$year."-".$month."-01";
$dt = strtotime($datestr);
$enddate = date('Y-m-d', strtotime('last day of this month', $dt));
$days = (strtotime($enddate) - strtotime($datestr)) / (60 * 60 * 24);
$userdetails = $connection->createCommand("select user_default_id,SUM(total_minutes) as minutes from `user_default_activity_date` where `date` between '$datestr' and '$enddate'  group by user_default_id ");
$drawresult = $userdetails->queryAll();
foreach($drawresult as $rows)
{
$user_points = $rows['minutes'];
$uid=$rows['user_default_id'];
$userdetails = $connection->createCommand("select * from `user_default_user` where `user_default_id`='$uid'");
$uresult = $userdetails->queryRow();
 $uname = $uresult['user_default_username'];
if($uname!="")
{
?>
<tr>
<td><?php echo $srno++; ?></td>
<td><?php echo $uname; ?></td>
<td><?php echo date("F", mktime(0, 0, 0,substr($month,0,2),date("d"), date("Y")))." ".substr($month,3,4); echo " ".$year; ?></td>
<td><?php echo floor($user_points); ?></td>
</tr>
<?php
}}}
?>
</table></div>
      </div>
      <!-- /End my-account-content -->
      <div class="clear"></div>
    </div>
	<?php } else { $link=Yii::app()->getBaseUrl(true); header("Location:".$link); } ?>