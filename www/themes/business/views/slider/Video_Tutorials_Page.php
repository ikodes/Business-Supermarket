<div class='home-slider-wrap'><div id='carousel-wrapper'><div id='dragongallery' class='stepcarousel'><div class='belt'><div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>Get quickly up to speed on finding your way round with a short video<br /><a href='javascript:void(0)' onclick="show_video('http://youtu.be/cG_tTVZZ_Bg');" title='' >Find out more ></a></p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->

 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png' alt=''/> <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/Business_supermarket_1436440262.png' alt='' style='float: right;position: relative;overflow: hidden;height: 287px; margin-top: -295px;margin-right: 24px;' />

</div>

<div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>We give you all the tools you need to market your business idea<br /><a href='javascript:void(0)' onclick="show_video('http://youtu.be/KFCg1N-FbNI');" title='' >Find out more ></a></p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->

 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png' alt=''/> <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/Business_supermarket_1436441230.png' alt='' style='float: right;position: relative;overflow: hidden;height: 287px; margin-top: -295px;margin-right: 24px;' />

</div>

<div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>Find out where there is a demand for your product or business idea<br /><a href='javascript:void(0)' onclick="show_video('http://youtu.be/KFCg1N-FbNI');" title='' >Find out more ></a></p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->

 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png' alt=''/> <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/Business_supermarket_1436441234.png' alt='' style='float: right;position: relative;overflow: hidden;height: 287px; margin-top: -295px;margin-right: 24px;' />

</div>

<div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>How we reward our members input and interaction with the site.<br /><a href='javascript:void(0)' onclick="show_video('http://youtu.be/Fn1rbdLG8nM');" title='' >Find out more ></a></p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->

 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png' alt=''/> <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/Business_supermarket_1436440707.png' alt='' style='float: right;position: relative;overflow: hidden;height: 287px; margin-top: -295px;margin-right: 24px;' />

</div>

<div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>Voice your opinion and be part of the next big thing<br /><a href='javascript:void(0)' onclick="show_video('http://youtu.be/pel1IW1kqjo');" title='' >Find out more ></a></p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->

 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png' alt=''/> <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/Business_supermarket_1436436414.png' alt='' style='float: right;position: relative;overflow: hidden;height: 287px; margin-top: -295px;margin-right: 24px;' />

</div>

<!-- /panel --> 



		<!-- End of carousel content -->



		</div> <!-- /belt -->



		</div>

        <p class='hideme'> <b>Current Panel:</b> <span id='statusA'></span> <b style='margin-left: 30px'>Total Panels:</b> <span id='statusC'></span> </p>

        <div id='gallery-navigation'>

  <p id='dragongallery-paginate' style='width: 740px'> <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/opencircle.png' alt='Business supermarket navigation buttons' data-over='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/graycircle.png' data-select='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/closedcircle.png' data-moveby='1' /> </p>

</div> <!-- /gallery-navigation -->



	<?php include('searchfunction.php'); ?>

		  

        </div> <!-- /carousel-wrapper -->

        </div> <!-- /slider-wrapper ends here -->

		

        <div class='home-video-wrap' style='display:none'> <!-- slider-wrapper start -->  

  <a href='javascript:void(0)' onclick='show_slider();' class='video-close'><img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/close.png' alt='business supermarket close button' width='24' /> </a>

  <div>

            <div class='stepcarousel' style='overflow: hidden;'>

      <div id='my-video'></div>

      <script type='text/javascript'>                      </script> 

    </div> <!-- /dragongallery End -->            

    </div> <!-- /carousel-wrapper End -->   

</div>

        <script type='text/javascript'>

    function show_video(video)

    {

       $('.home-slider-wrap').css('display','none');

        $('.home-video-wrap').fadeIn('fast');

        jwplayer('my-video').setup({

            file: video,

            image: '<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/robot/defult-video.png',

            width: '640',

            height: '360',

            autostart:'true',

            events: {

                onComplete: function() { show_slider(); }

            }

        });

    }



    function show_slider()

    {

       $('.home-slider-wrap').css('display','inline');

        $('.home-video-wrap').css('display','none');

    }

</script> 

        