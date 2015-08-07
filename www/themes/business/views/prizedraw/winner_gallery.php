<div id="carousel-wrapper-2" style="padding-left:0px"> 

    <ul id="car-new" class="jcarousel-skin-tango">

<?php
$data= PrizeDrawWinners::model()->findAll();
foreach($data as $prizes)
{
$drawdate=$prizes['date_draw'];
$dd=explode('-',$drawdate);
$month=$dd[1];
if($month=="01") { $monthval="January"; } else if($month=="02") { $monthval="February"; } else if($month=="03") { $monthval="March"; } else if($month=="04") { $monthval="April"; } else if($month=="05") { $monthval="May"; } else if($month=="06") { $monthval="Jun"; } else if($month=="07") { $monthval="July"; } else if($month=="08") { $monthval="August"; } else if($month=="09") { $monthval="September"; } else if($month=="10") { $monthval="October"; } else if($month=="11") { $monthval="November"; } else if($month=="12") { $monthval="December"; }
$year=$dd[2];
$userid=$prizes['user_default_id'];
$connection = Yii::app()->db;
$getslider = $connection->createCommand("select * from `user_default_profiles` where `user_default_id`='$userid'");
$sliderresult = $getslider->queryRow();
$username = $sliderresult['user_default_username'];
//$uname = $sliderresult['user_default_profilesname'];
$usertype = $sliderresult['user_default_type'];
$folder=$username."_".$userid;
$baseurl=Yii::app()->getBaseUrl(true);
?>
        <li >

 <div style='font-size:8px' class="smallpanel" >


                       <div style='text-align:center'><?php echo $monthval." ".$year ?>    <?php //echo $prizes['prize_won_amount']; ?></div>
<?php
if($sliderresult['user_default_profile_image']!="")
{
if($usertype=="business")
{
?><img src="<?php echo $baseurl."/upload/logo/".$sliderresult['user_default_profile_image'] ; ?>" style=" width: 93px;height: 86px;"/>
  
<?php
}
else
{
?><img src="<?php echo $baseurl."/upload/users/".$folder."/images/".$sliderresult['user_default_profile_image'] ; ?>" style=" width: 93px;height: 86px;"/>
  <?php
  }
}
else
{
?>
					   <img src="<?php echo $baseurl; ?>/upload/logo/avatar.jpg" style=" width: 93px;"/>
  <?php
}
?>  <div class="clear"><br /></div>

                        <p>Name : <?php echo $username; ?><br />Date of Draw : <?php echo $drawdate; ?><br/>Prize value : $<?php echo $prizes['prize_won_amount']; ?></p>

                    </div>
        </li> <!-- Science &amp; Technology List End -->   

<?php
}
?>
    </ul>

</div> <!-- /carousel-wrapper-2 End -->
<style>
.jcarousel-skin-tango .jcarousel-clip-horizontal {   width: 519px !important; }
.jcarousel-skin-tango .jcarousel-item-horizontal {   width: 103.5px !important; }
.smallpanel { width: 95.5px !important }
.jcarousel-skin-tango .jcarousel-prev-horizontal { background: transparent url('<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/carousel-arrow-left-blue-new.png') no-repeat 0 0;  top: 17px; }
.jcarousel-skin-tango .jcarousel-next-horizontal { background: transparent url('<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/carousel-arrow-right-blue-new.png') no-repeat 0 0;  top: 17px; }
.prize-draw-box {
	float: left;
	width: 620px;
	height: auto;
	padding-left: 6px;
}
.prize-draw-box {
    width:606px;
    margin-left:6px;
    border:2px solid #808080;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    padding:5px;
}
</style>
<script type="text/javascript">

// Controls bottom carousel

    jQuery(document).ready(function() {

        jQuery('#car-new').jcarousel({

         wrap: 'circular',

          scroll: 1,visible:5
      

        });

    });

</script>