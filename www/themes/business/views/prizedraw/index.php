<?php
$user_default_id = Yii::app()->user->id;
			
if($user_default_id!="")
{
$this->breadcrumbs=array(
	'Prize Draw',
);
$year=date('Y');
$month=date('m');
$connection = Yii::app()->db;
$command = $connection->createCommand("select * from `user_default_prize_draw` where `year`='$year' and month='$month'");
$myresult = $command->queryRow();
$pricereq = $myresult['points_required'];
$price = $myresult['prize_value'];
$datestr=$year."-".$month."-01";
$curdate=date("Y-m-d");
$dt = strtotime($curdate);
$enddate = date('Y-m-d', strtotime('last day of this month', $dt));
$days = (strtotime($enddate) - strtotime($curdate)) / (60 * 60 * 24);

$connection = Yii::app()->db;
$userdetails = $connection->createCommand("select SUM(total_minutes) as minutes from `user_default_activity_date` where `user_default_id`='$user_default_id' and `date` between '$datestr' and '$enddate'");
$drawresult = $userdetails->queryRow();
$user_points = $drawresult['minutes'];
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

               <!-- /End my-account-links -->
        <div class="prize-draw-box" style='border:none'>
          <div style="font-size:10px;"> 
              <h2 style="text-align:center;">How does the Prize Draw work?</h2><br />
            <p>The prize draw is carried out at the end of every month.</p><p>
All members points are reset to zero at the beginning of the draw</p><p>
Each draw starts at the beginning of each calender month and ends
on the last day of that month so that there are 12 draws per year.</p><p>
You acquire points through interaction with the site and other members. For example you get points for voting, leaving a comment,
watching members videos, taking part in public forum etc.</p><p>
Members can award points for your valued input.</p><p>
You get points for every like (thumbs-up) on the comments you leave and lose points for spam or abuse.</p><p>
Points you acquire on each visit are collected and then credited to your account in 24 hours.
</p>
            <p>For full details, terms and conditions <a href="#">click here>></a></p>
          </div>
          <div class="clear"></div>
          <hr />
          <table border="0" style="font-size: 1.0em; text-align: center;"width="100%" cellpadding="3" cellspacing="3">
            <tr>
              <td><em>Points required for entry</em></td>
              <td><em>Points acquired so far</em></td>
              <td><em>Days remaining</em></td>
            </tr>
            <tr style="color:#A84793; font-style: italic; font-size: 1.2em; text-align: center; font-weight: bold;">
              <td><?php echo $pricereq;?></td>
              <td><?php echo floor($user_points);?></td>
              <td><?php echo $days;?></td>
            </tr>
          </table>
          <table border="0" style="font-size: 1.0em; text-align: center;"width="100%" cellpadding="3" cellspacing="3">
            <tr>
              <td></td>
              <td><em>Value of prize draw this month</em></td>
              <td></td>
            </tr>
            <tr style="color:#A84793; font-style: italic; font-size: 1.2em; text-align: center; font-weight: bold;">
              <td></td>
              <td>$<?php echo $price;?></td>
              <td></td>
            </tr>
          </table>
		  <div class="clear"></div><br/>
		  <div align="center" class="box1" style="  background-color: rgb(132, 132, 132);
  color: white;
  border-radius: 3px;
  padding: 6px;
  font-size: 17px;
  font-weight: 800;">Winners Gallery</div> <div align="center">    <?php 

                $this->renderPartial("winner_gallery"); 

              ?></div>
          <div class="clear"></div>
          <!-- bottom carousel -->
     
        </div>
        <!-- /End prize-draw-box -->
      </div>
      <!-- /End my-account-content -->
      <div class="clear"></div>
    </div>
	<?php } else { $link=Yii::app()->getBaseUrl(true); header("Location:".$link); } ?>