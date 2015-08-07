<!-- Start of Registered User accordion wrap -->
<?php
if(Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/create" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/user_listing_step2" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/user_listing_step3" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/user_listing_step4")
{
?>

<div class="accordian-wrap">
    <div id="accordion">
        <h3 class="aorange">Video Tutorials</h3>
        <div class="aorange accordian-box">
            <ul>
                <li>
                    <a href="javascript:void(0);" class="clearfix"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/FAQ-button.png" alt='FAQ button image' width="30" height="19" />How to navigate the site</a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="clearfix"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/How-to-list-button.png" alt='How to list your idea button' width="30" height="19" />Beginners guide on how to list</a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="clearfix"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/contact-entrepreneur.png" alt='Contact the entrepreneur button' width="30" height="19" />How to protect your idea</a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="clearfix"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/lost.png" alt='Lost password button' width="30" height="19" />How to get help</a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="clearfix"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/How-to-navigate-button.png" alt='How to navigate the site button' width="30" height="19" />Download listing templates</a>
                </li>
            </ul>
        </div>
        
        <h3 class="agreen">your recent activity</h3>
        <div class="agreen accordian-box">
            <ul>
                <li>
                    <span class='text'>Quickly review your recently viewed items</span>
                </li>
                <li>
                    <a href="javascript:void(0);">3D TV Video switcher 1234567890 <span class="coloragreen">View listing &#62;&#62;</span></a>
                </li>
                <li>
                    <a href="javascript:void(0);">Drivestop an anti Petrol theft device 1234567890 <span class="coloragreen">View listing &#62;&#62;</span></a>
                </li>
                <li>
                    <a href="javascript:void(0);">Drivestop an anti Petrol theft device 1234567890 <span class="coloragreen">View listing &#62;&#62;</span></a>
                </li>
            </ul>
            <p><a href="javascript:void(0);">See More Items &#62;&#62;</a></p>
        </div>
        
        <h3 class="adarkgreen">my notices</h3>
        <div class="adarkgreen accordian-box">
            <ul>
                <li>
                    <a href="javascript:void(0);">Your listing Plummate has had 135,144 visits & 127,456 votes<br /> Find out <span class="coloradgreen"> more &#62;&#62;</span></a>
                </li>
                <li>
                    <a href="javascript:void(0);">You do not have a listing yet. <br/>It easier than you think <span class="coloradgreen"> more &#62;&#62;</span></a>
                </li>
                <li>
                    <a href="javascript:void(0);">A business idea you are bidding on is due to end in 3 days<span class="coloradgreen"> more &#62;&#62;</span></a>
                </li>
            </ul>
            <p><a href="javascript:void(0);">See More Items &#62;&#62;</a></p>     
        </div>
    </div>
</div> <!-- end of Registered User accordion wrap -->    


    
<?php
}
else
{
?>
<div class="accordian-wrap">
    <div id="accordion">
        <h3 class="aorange">quick links</h3>
        <div class="aorange accordian-box">
            <ul>
                <li>
                    <a href="<?php echo $this->createUrl('/video_tutorials'); ?>" title='goto site videos' >
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" alt='Goto tutorial videos button' height="19" width="30" />View demonstration videos
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" onclick="show_video('http://youtu.be/Fn1rbdLG8nM');" title='Business Supermarket prize draw' >
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/Prize-draw.png" alt='Goto prize draw button' height="19" width="30" />Prize Details
                    </a>
                </li>
                <li>
                    <a href="http://www.business-supermarket.co.uk/user/myaccount/update">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/My-Account.png" alt='Goto my account button' height="19" width="30" />Go to my account
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" onclick="show_video('http://youtu.be/E-NVH6zbTP4');" title='How to navigate the Business Supermarket website' >
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/How-to-navigate-button.png" alt='View how to navigate the site button' height="19" width="30" />Navigate the site
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" onclick="show_video('http://youtu.be/ORu_3dSYDV0');" title='How to list your business idea on the Business Supermarket website' >
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/How-to-list-button.png" alt='How to list your idea button' height="19" width="30" />How to list
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->createUrl('/page/faq');?>" title='goto FAQ' >
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/FAQ-button.png" alt='Goto to FAQ&#180;s button' height="19" width="30" />Frequently asked questions
                    </a>
                </li>
            </ul>
        </div>
        
        <h3 class="agreen">your recent activity</h3>
        <div class="agreen accordian-box">
            <ul>
                <li>
                    <span class='text'>Quickly review your recently viewed items</span>
                </li>
                <li>
                    <a href="javascript:void(0);">3D TV Video switcher 1234567890 <span class="coloragreen">View listing &#62;&#62;</span></a>
                </li>
                <li>
                    <a href="javascript:void(0);">Drivestop an anti Petrol theft device 1234567890 <span class="coloragreen">View listing &#62;&#62;</span></a>
                </li>
                <li>
                    <a href="javascript:void(0);">Drivestop an anti Petrol theft device 1234567890 <span class="coloragreen">View listing &#62;&#62;</span></a>
                </li>
            </ul>
            <p><a href="javascript:void(0);">See More Items &#62;&#62;</a></p>
        </div>
        
        <h3 class="adarkgreen">my notices</h3>
        <div class="adarkgreen accordian-box">
            <ul>
                <li>
                    <a href="javascript:void(0);">Your listing Plummate has had 135,144 visits &amp; 127,456 votes<br/> Find out <span class="coloradgreen"> more &#62;&#62;</span></a>
                </li>
                <li>
                    <a href="javascript:void(0);">You do not have a listing yet. <br/>It easier than you think <span class="coloradgreen"> more &#62;&#62;</span></a>
                </li>
                <li>
                    <a href="javascript:void(0);">A business idea you are bidding on is due to end in 3 days<span class="coloradgreen"> more &#62;&#62;</span></a>
                </li>
            </ul>
            <p><a href="javascript:void(0);">See More Items &#62;&#62;</a></p>     
        </div>
    </div>
</div> <!-- end of Registered User accordion wrap -->   
<?php
}
?>

<!-- Don't forget analytics --> 

<script type="text/javascript">
    
    // Accordian script
    // var JQA = jQuery.noConflict();
        
    $(function() {
         $( "#accordion" ).accordion({
            heightStyle: "content"
        });
    });
</script>