<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico" />
    <link rel="icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico" />   
    <script type="text/javascript">var $baseurl = '<?php echo Yii::app()->baseUrl; ?>'</script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>  
    <?php 
    $themepath = Yii::app()->theme->baseUrl;      
    Yii::app()->clientScript->registerCssFile($themepath.'/css/menuh.css');        
    Yii::app()->clientScript->registerCssFile($themepath.'/css/fonts/fonts.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/button.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/style.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/tooltips.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/chosen.css');  
    Yii::app()->clientScript->registerCssFile($themepath.'/css/uploadimage.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/fonts/fonts.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/financials.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/media.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/faq.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/ManageFinancials.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/VoiceOpinion.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/marketlisting.css');
	Yii::app()->clientScript->registerCssFile($themepath.'/css/search.css');
	
    /* Included CSS Files by Anand
    Yii::app()->clientScript->registerCssFile($themepath.'/css/my_messages.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/downloads.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/jquery.rating.css');
    Yii::app()->clientScript->registerCssFile($themepath.'/css/user_listing.css');
    /* End Included CSS Files by Anand */

    Yii::app()->clientScript->registerCssFile($themepath.'/css/business_listing.css');
     Yii::app()->clientScript->registerCssFile($themepath.'/css/user_listing.css');
  
	Yii::app()->clientScript->registerScriptFile($themepath.'/js/jquery-1.11.1.min.js?ver=3.3.1');    
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/chosen.jquery.js');
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/ui-1.9.2-jquery-ui.js');
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/jquery.js?ver=3.3.1');    
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/jquery.form.min.js');

    if(Yii::app()->controller->id!='search') {
        Yii::app()->clientScript->registerScriptFile($themepath . '/js/step-car.js');
    }
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/noty/jquery.noty.js');
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/noty/layouts/inline.js');
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/noty/layouts/topRight.js');
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/noty/themes/default.js');
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/jwplayer/jwplayer.js');
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/tinymce/tinymce.min.js');
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/jquery.jcarousel.min.js');  
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/idle_timer.js');  
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/jquery.timer.js');   
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/common.js');
    Yii::app()->clientScript->registerScriptFile($themepath.'/js/jquery.poshytip.js');

    /* Search js */
    Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.search.assets')) . '/js/search_engine.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.search.assets')) . '/js/search_common.js');

    Yii::app()->clientScript->registerCssFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.forum.assets')) . '/css/forum.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.forum.assets')) . '/js/common.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.forum.assets')) . '/js/engine.js');

    Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.mymessage.assets')) . '/mymessages.common.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.mymessage.assets')) . '/mymessages.engine.js');

    ?>    
    <?php if(!Yii::app()->user->isGuest) {?>  
    <script type="text/javascript">
    var tt_exp = "3";
    var action='';
    tt_exp     = (parseInt(tt_exp) * 60 * 1000);             
    jQuery(document).bind("idle.idleTimer", function(){
        console.log('You are Idle!');
        myFunction(0);
    });
    jQuery(document).bind("active.idleTimer", function(){
        console.log('You are Active!');
        myFunction(1);        
    });
    jQuery.idleTimer(tt_exp);     
     
    
    function myFunction(type) {
        if(type==1)
            action = 'active';
        else
            action = 'idle';
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createUrl('/ajax');?>/'+action,
            data: {type: 'system'},
            async: false,
            success: function(response) {
                if(response == 1)
                    console.log('Activity recorded successfully!');
            },
            error: function(request, error) {
                console.log("Unknown error."+error);
            }
        });
    }
    </script> 
    <?php }?>   
    <script type="text/javascript">
         function generate(type,msg) {
		var n = noty({
			text: msg,
			type: type,
		  dismissQueue: false,
			layout: 'topRight',
			theme: 'defaultTheme'
		});
		console.log('html: '+n.options.id);
		return n;
	  } 
      function close_all_notice(type)
	  {
		  setTimeout(function()
			{
				jQuery.noty.closeAll(type.options.id);
			},2000); 
	  }
	  var baseUrl = '<?php  echo Yii::app()->baseUrl;?>'; 
            	  
       
    </script>
    
</head> 
<body class="drg-body art-<?php echo Yii::app()->controller->id;?>" style="width: 1025px; position: relative; margin: 0px auto;">
<?php if(!empty(Yii::app()->session['message'])){?> 
    <script type="text/javascript">    
   	  jQuery(document).ready(function()
	  {
	       <?php $messages = Yii::app()->session['message']; ?>
  		   <?php 
       
            foreach($messages as $key=>$message){ ?> 
             var success = generate('<?php echo $key; ?>','<?php echo $message; ?>');
  		
	  		 setTimeout(function()
			{
				jQuery.noty.closeAll(success.options.id);
			},2000); 
            <?php 
            Yii::app()->session->remove('message');
            } ?>
	  });
  </script>
<?php } ?>
<div id="loading-div" style="display: none;">
    <img style="margin: 25%;" src="<?php echo Yii::app()->theme->baseUrl;?>/images/loader.gif" alt="loading" title="loading image" />
</div>
<div id="shadow-wrap">
    <?php 
       /* $this->renderPartial('//layouts/top_menu');
        echo $content  ;
        $this->renderPartial('//layouts/footer');
       */
    ?>

    <?php

    if(Yii::app()->controller->id=='search'){

        ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".home-slider-wrap").empty();

            });
        </script>
    <?php  }

       // print_r($_REQUEST); 
    	if(Yii::app()->controller->id=='listing' && in_array(Yii::app()->controller->action->id,array('rejection','publish','rdelete','suspension','restore')) && Yii::app()->user->isGuest)
		{
		?>
        	 <script type="text/javascript">
               $(document).ready(function(){
                    $(".home-slider-wrap").empty();
                    $("#rightbar").remove();
                    
                });
            </script>
		<?php
		}
        else if(Yii::app()->controller->id=='mymessages' && in_array(Yii::app()->controller->action->id,array('nologin'))){
        ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".home-slider-wrap").empty();
                $("#rightbar").remove();
            });
        </script>
         <?php  }
		else if(Yii::app()->controller->id=='businesslisting' && in_array(Yii::app()->controller->action->id,array('nologin','rejection','publish','rdelete','suspension','restore')) && Yii::app()->user->isGuest)
		{
		 ?>	
         <script type="text/javascript">
               $(document).ready(function(){
                    $(".home-slider-wrap").empty();
                    $("#rightbar").remove();
                    
                });
         </script>
		
        <?php
        }else if(Yii::app()->controller->id=='banner' && in_array(Yii::app()->controller->action->id,array('reject')) && Yii::app()->user->isGuest)
		{
		 ?>	
         <script type="text/javascript">
               $(document).ready(function(){
                    $(".home-slider-wrap").empty();
                    $("#rightbar").remove();
                    
                });
         </script>
		
        <?php
        }
		else
		{
        	$this->renderPartial('//layouts/top_menu');
		}
        if(Yii::app()->controller->id=='search') {
            echo '<div style="margin-left: 42px;">';
            echo $content;
            echo '</div>';
        }else{
            echo $content;
        }
		if(Yii::app()->controller->id=='listing' && in_array(Yii::app()->controller->action->id,array('rejection','publish','rdelete','suspension','restore')) && Yii::app()->user->isGuest)
		{
        	
		}
        else if(Yii::app()->controller->id=='mymessages' && in_array(Yii::app()->controller->action->id,array('nologin'))){

        }
		else if(Yii::app()->controller->id=='businesslisting' && in_array(Yii::app()->controller->action->id,array('nologin','rejection','publish','rdelete','suspension','restore')) && Yii::app()->user->isGuest)
		{
			
		}
		else
		{
			$this->renderPartial('//layouts/footer');
		}
    ?> 
</div>
<span id="stopwatch"></span>
</body>
<?php if(Yii::app()->controller->id=='search') {?>
    <script type="text/javascript">
        $(document).ready(function(){
            // $("#rightbar div").removeClass('robo-image');
            $('.robo-image').css({'display' : 'none'});
        });
    </script>
<?php } ?>
</html>

