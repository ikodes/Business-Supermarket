<script type="text/javascript">
	function show_video(video)
	{
		$('.home-slider-wrap').fadeOut();
		$('.home-video-wrap').fadeIn('slow'); 
		 jwplayer('my-video').setup({
                file: video,
                image: '/themes/business/images/robot/defult-video.png',
                width: '640',
                height: '360',
                autostart:'true',
                events: { 
                    onComplete: function() { window.location='../index.php'; } 
                }                 
            });
		
	}		function play_video(video)	{		$('.home-slider-wrap').fadeOut();		$('.home-video-wrap').fadeIn('slow'); 		 jwplayer('my-video').setup({                file: video,                image: '/themes/business/images/robot/defult-video.png',                width: '640',                height: '360',                autostart:'true',                events: {                     onComplete: function() { $('.home-slider-wrap').fadeIn('slow');		$('.home-video-wrap').fadeOut('fast'); }                 }                             });			}
	
	function show_slider()
	{
		$('.home-slider-wrap').fadeIn('slow');
		$('.home-video-wrap').fadeOut('fast');
	}
</script>

<div class="add-carousel"><!--start advertiser carousel-----> 

<?php 



//$user_all_banners=$db->selectArrRecords("drg_banner_ads","banner_path,banner_link,banner_id,drg_user_id","banner_approve_status=1");

//$totalResults=$db->CountQuery("drg_banner_ads","*","banner_approve_status=1");



$user_all_banners = Bannerads::model()->findAll("banner_approve_status=2");



if(count($user_all_banners)!=0){?>

      <ul id="add-carousel-wrap" class="jcarousel-skin-ie7">

      

         <?php 

            foreach($user_all_banners as $bannerval){

            ?>

                 <li>

                 <?php 

                  $username = User::model()->find('drg_id='.$bannerval->drg_user_id);                  

                 ?>

                 <a href="<?php echo $bannerval->banner_link;?>"  target="_blank" onclick="javascript:updateHit(<?php echo $bannerval->banner_id;?>)">

                    <img src="<?php echo Yii::app()->baseUrl.'/upload/'.$bannerval->banner_path; ?>" height="77" width="420" title="Image Name: <?php echo $bannerval->banner_path; ?>" />

                 </a>  

                 </li>

	

            <?php     

            }

         ?>   

      </ul>

<?php }else{ ?>

        <ul id="add-carousel-wrap" class="jcarousel-skin-ie7">

            <li><img src="<?php Yii::app()->baseUrl; ?>/upload/ad_banner/active/advertise-here.png" height="77" /></li>

            <li><img src="<?php Yii::app()->baseUrl; ?>/upload/ad_banner/active/business-help-ad.png" height="77" /></li>

            <li><img src="<?php Yii::app()->baseUrl; ?>/upload/ad_banner/active/dragonsnet.png" height="77" /></li>

            <li><img src="<?php Yii::app()->baseUrl; ?>/upload/ad_banner/active/member-listing-ad.png" height="77" /></li>

            <li><img src="<?php Yii::app()->baseUrl; ?>/upload/ad_banner/active/business-support-ad.png" height="77" /></li>

            <li><img src="<?php Yii::app()->baseUrl; ?>/upload/ad_banner/active/skill-mentor-ad.png" height="77" /></li>

        </ul>

<?php } ?>

 </div> <!-- /end advertiser carousel -->
 <?php
 $connection = Yii::app()->db;
$contract=Yii::app()->controller->id."/".Yii::app()->controller->action->id;
$getslider = $connection->createCommand("select * from `drg_slider_listing` where `page_name`='$contract'");
$sliderresult = $getslider->queryRow();
$sliderid = $sliderresult['slider_id'];

$getsliderbtns = $connection->createCommand("select * from `drg_slider_btns` where `slider_id`='$sliderid'");
$sliderresults = $getsliderbtns->queryRow();
$sliderids = $sliderresults['slider_id'];
if($sliderids!="")
{
?>
 <div id="how-to-div" class="clearfix"> 
 <?php
 $getsliderbtnss = $connection->createCommand("select * from `drg_slider_btns` where `slider_id`='$sliderid' order by `btn_id` ASC");
$getbtns = $getsliderbtnss->queryAll();
foreach($getbtns as $data )
{
if($data['btn_videolink']!="")
{
?>
<a href="javascript:void(0)" onclick="play_video('<?php echo $data['btn_videolink']; ?>');" class="clearfix"> 
<?php 
}
else
{
?>
<a href="<?php echo $data['btn_sitelink']; ?>" class="clearfix"> 
<?php
}
?>
<img src="<?php echo Yii::app()->baseUrl; ?>/themes/business/images/buttons/<?php echo $data['btn_image']; ?>" width="30" /><?php echo $data['btn_text']; ?></a> 
         
<?php 
}
?>
</div>
<?php
}
else if(Yii::app()->urlManager->parseUrl(Yii::app()->request)=="businesslisting/businesslisting/view" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="businesslisting/businesslisting/preview_business_listing"  || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="businesslisting/businesslisting/rdelete" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="businesslisting/businesslisting/fupdate")
{
$lid=$_GET['id'];
if($lid=="")
{
$lid = Yii::app()->request->getParam('blistid');
}
$connection = Yii::app()->db;
$command1 = $connection->createCommand("select * from `drg_business_listing` where `drg_blid`='$lid'");
$myresult1 = $command1->queryRow();
$uid1=$myresult1['drg_video1'];
$uid2=$myresult1['drg_video2'];
$drg_uid=$myresult1['drg_uid'];
$ncommand1 = $connection->createCommand("select * from `drg_user` where `drg_uid`='$drg_uid'");
$nmyresult1 = $ncommand1->queryRow();
$userfolder=$nmyresult1['drg_username']."_".$nmyresult1['drg_id'];
$command11 = $connection->createCommand("select * from `drg_blisting_videos` where `drg_blid`='$lid' order by drg_video_id asc limit 1");
$myresult11 = $command11->queryRow();
$file1=$myresult11['drg_listing_video'];
$path11 = $_SERVER['DOCUMENT_ROOT'].'/';
 $apath1= $path11."upload/users/".$userfolder."/videos/".$file1;
 if (file_exists($apath1))
 {
 $videofile1= Yii::app()->getBaseUrl(true)."/upload/users/".$userfolder."/videos/".$file1;
 }
 else
 {
 $videofile1=$uid1;
 }
 $command22 = $connection->createCommand("select * from `drg_blisting_videos` where `drg_blid`='$lid' order by drg_video_id desc limit 1");
 $myresult22 = $command22->queryRow();
 $file2=$myresult22['drg_listing_video'];
 $path11 = $_SERVER['DOCUMENT_ROOT'].'/'; 
 $apath2= $path11."upload/users/".$userfolder."/videos/".$file2;
 if (file_exists($apath2))
 {
 $videofile2= Yii::app()->getBaseUrl(true)."/upload/users/".$userfolder."/videos/".$file2;
 }
 else
 {
 $videofile2=$uid2;
 }
 $ufold=Yii::app()->user->getState('ufolder');
?>
 <div id="how-to-div" class="clearfix"> 
         <a href="javascript:void(0)" onclick="play_video('<?php echo $videofile1; ?>');" class="clearfix"> 
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />Get to know the entrepreneur</a> 
         <a href="javascript:void(0)" onclick="play_video('<?php echo $videofile2; ?>');" class="clearfix"> 
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />Get to know the business idea</a> 
         <a href="#" class="clearfix" id="<?php if($ufold!="") { echo "contactpopup"; } else { echo "loginerrpopup"; } ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/FAQ-button.png" width="30" />Contact the entrepreneur</a> 
</div>
<?php
}
else
{
?>

 <div id="how-to-div" class="clearfix"> 

        <a href="#;" class="clearfix">

            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />How to list your business idea</a> 

        <a href="#;" class="clearfix">

            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30" />How to navigate the site</a> 

        <a href="#;" class="clearfix">

            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/FAQ-button.png" width="30" />Frequently asked questions</a> 

</div>
<?php 
}
?>
 

 

<script language="javascript" type="text/javascript">

function updateHit(bannerId){

	jQuery.ajax({				

    	type:"POST",

    	url:"updateHit.php",

    	data:"banner_id="+bannerId,

    	cache: false,

    	success:function(response){

    	},

    	fail:function(error){

    		alert(error);

   		}

	});

}

// Advert Carousel

function mycarousel_initCallback(carousel)

{

    carousel.clip.hover(function() {

        carousel.stopAuto();

    }, function() {

        carousel.startAuto();

    });

};

jQuery(document).ready(function() {

    jQuery('#add-carousel-wrap').jcarousel({

        wrap: 'circular',

        scroll: 1,

		 hoverPause: true,

     initCallback: mycarousel_initCallback

    });

    });

</script>

