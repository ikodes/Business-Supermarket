<?php
if(Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/view" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/preview_user_listing" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/rdelete" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="listing/listing/fupdate")
{
    $lid=$_GET['id'];
    if($lid=="")
    {
        $lid = Yii::app()->request->getParam('listid');
    }
    $connection = Yii::app()->db;
    $command12 = $connection->createCommand("select * from `user_default_listing_images` where `user_default_listing_id`='$lid'");
    $count_val=count($command12);
    if($count_val!="")
    {		$cimage=$command12->queryRow();
        if($cimage['user_default_listing_image']!="")
        {
            ?>

<div class="home-slider-wrap"> <!-- slider-wrapper start -->
  
  <div id="carousel-wrapper">
    <div id="dragongallery" class="stepcarousel">
      <div class="belt"> 
        
        <!-- Start of carousel contents -->  
        <?php
            $lid=$_GET['id'];
            if($lid=="")
            {
                $lid = Yii::app()->request->getParam('listid');
            }
            $command1 = $connection->createCommand("select * from `user_default_listing` where `user_default_listing_id`='$lid'");
            $myresult1 = $command1->queryRow();
            $uid=$myresult1['user_default_profiles_id'];
            $command2 = $connection->createCommand("select * from `user_default_profiles` where `user_default_id`='$uid'");
            $myresult2 = $command2->queryRow();
            $uid=$myresult2['user_default_id'];
            $uname=$myresult2['user_default_username'];
            $upath=$uname."_".$uid;
            $dataReader = $connection->createCommand("SELECT * FROM user_default_listing_images where user_default_listing_id='$lid' order by user_default_listing_image_id asc")->queryAll();
            foreach( $dataReader as $row ) 
                {
                    $img = $row['user_default_listing_image'];
                    $desc = $row['user_default_listing_image_text'];
					$sitelink = $row['user_default_listing_image_link1'];
					$videolink = $row['user_default_listing_image_link2'];
        ?>
                    <div class="panel">
                      <div class="paneloverlay-wrapper">
                        <div class="paneloverlay-top">&nbsp;</div>
                        <div class="paneloverlay">
                          <p class="speech-bubble"><?php echo $desc ; ?>
						  <?php
						  if($sitelink!="")
{
echo "<br/><a href='$sitelink'  title='' target='_blank' >Find out more ></a>";
}
else if($videolink!="")
{
echo "<br/><a href='javascript:void(0)' onclick=\"show_video('$videolink');\" title='' >Find out more ></a>";
}
?>
</p>
                          <p class="speech-bubble-sig"></p>
                        </div> <!-- /paneloverlay -->

                        <div class="paneloverlay-bottom">&nbsp;</div>
                      </div> <!-- paneloverlay-wrapper --> 

                      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/blank.png">
                      <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/users/<?php echo $upath; ?>/listing/big/<?php echo $img; ?>" alt="<?php echo $desc ; ?>" 
                           style="float: right;
                                  position: relative;
                                  overflow: hidden;
                                  margin-top: -298px;width: 470px;
                                  height: 290px;
                                  margin-right: 24px;
                        }"/> 
                    </div> <!-- /panel --> 
                    <?php
                }
                            ?> 
        <!-- End of carousel content -->       
      </div> <!-- /belt -->      
    </div> <!-- /End if gallery --> 
    
    <p class="hideme"> <b>Current Panel:</b> <span id="statusA"></span> <b style="margin-left: 30px">Total Panels:</b> <span id="statusC"></span> </p>
    <div id="gallery-navigation">
      <p id="dragongallery-paginate" style="width: 740px"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/opencircle.png" alt="Business supermarket navigation buttons" data-over="<?php echo Yii::app()->theme->baseUrl; ?>/images/graycircle.png" data-select="<?php echo Yii::app()->theme->baseUrl; ?>/images/closedcircle.png" data-moveby="1" /> </p>
    </div> <!-- /End of gallery-navigation -->
    
    <div id="search-tab">
      <input type="text" onblur="this.value='Search site...'" onfocus="" value="Search site..." />
      <a href="user_listing_search.php" title="Search the site" id="searchbtn"></a>
    </div> <!-- /End of search-tab --> 
    
  </div> <!-- /End of carousel-wrapper --> 
  
</div> <!-- /End of slider-wrapper ends here -->

<div class="home-video-wrap" style="display:none"> <!-- slider-wrapper start --> 
  
  <a href="javascript:void(0)" onclick="show_slider();" class="video-close"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" alt="business supermarket close button" width="24" /> </a>
  <div id="carousel-wrapper1">
    <div id="dragongallery1" class="stepcarousel">
      <div id='my-video'></div>
      <script type='text/javascript'></script> 
    </div> <!-- /dragongallery End -->    
  </div> <!-- /carousel-wrapper End -->   
</div>

<?php
        }
    else
        {
?>

<div class="home-slider-wrap"> <!-- slider-wrapper start -->
  <div id="carousel-wrapper">
    <div id="dragongallery" class="stepcarousel">
      <div class="belt">
        
        <!-- Start of carousel contents -->      
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">What is Business-supermarket?<br />
                A website for you to help you change your financial future.<br />
                <a href="javascript:void(0)" onclick="show_video('http://youtu.be/GQvhj2-dh-c');" title='Business supermaket designed to help you start your own business' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div>
            
            <!-- /paneloverlay -->            
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div> <!-- /End of paneloverlay-wrapper --> 
          
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/what-is-dragonsnet-business-supermarket.png" alt="Worlds first business supermarket" /> </div>
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">Get free entry to our cash prize draw for your efforts every month.<br />
                <a href="javascript:void(0)" onclick="show_video('http://youtu.be/irhJrkLAZ0E');" title='Enter the Business supermarket free to enter cash prize draw' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div> <!-- /paneloverlay -->            
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div> <!-- / End of paneloverlay-wrapper --> 
          
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/consumer-visitor.png" alt="How Business supermarket can help the consumer or a visitor to change their financial future" /> </div>
        
        <!-- /panel -->         
        <!-- Start of carousel contents 2-->       
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">If your idea is good enough; we will put up the funding you need to take it to market.<br />
                <a href="javascript:void(0)" onclick="show_video('http://youtu.be/irhJrkLAZ0E');" title='How Business supermarket can help a new business get funding video' >Find out more ></a></p>
            </div> <!-- /paneloverlay -->
            
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div>
          
          <!-- paneloverlay-wrapper -->      
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/invention-funding.png" alt="How Business supermarket can help you get funding for your business idea or new startups." /> </div>
        
        <!-- /panel -->       
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">Got a skill? Then exploit it here; become a teacher, mentor or a business partner.<br />
                <a href="javascript:void(0)" title='Get financially better off by offering your knowledge and skill to a business on Business supermarket video' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div> <!-- /End of paneloverlay -->        
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div> <!-- / End of paneloverlay-wrapper --> 
          
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/subcontracting.png" alt="How Business supermarket can help the consumer" /> </div>
        
        <!-- /panel -->        
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">Voice your opinion and be part of the next big thing.<br />
                <a href="javascript:void(0)" title='Voice your opinion and help on Business supermarket and shape the next big thing video' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div> <!-- /End of paneloverlay -->
            
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div>
          
          <!-- paneloverlay-wrapper -->          
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/public-opinion.png" alt="Business supermarket allows yo have your say" /> 
        </div> <!-- /End of panel -->         
        <!-- End of carousel content -->       
      </div> <!-- /End of belt -->       
    </div> <!-- /End of dragongallery --> 
      
    <p class="hideme"> <b>Current Panel:</b> <span id="statusA"></span> <b style="margin-left: 30px">Total Panels:</b> <span id="statusC"></span> </p>
    <div id="gallery-navigation">
      <p id="dragongallery-paginate" style="width: 740px"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/opencircle.png" alt="Business supermarket navigation buttons" data-over="<?php echo Yii::app()->theme->baseUrl; ?>/images/graycircle.png" data-select="<?php echo Yii::app()->theme->baseUrl; ?>/images/closedcircle.png" data-moveby="1" /> </p>
    </div> <!-- /End of gallery-navigation -->
    
    <div id="search-tab">
      <input type="text" onblur="this.value='Search site...';" onfocus="this.value='';" value="Search site..." />
     <a href="user_listing_search.php" title="Search the site" id="searchbtn"></a> </div> <!-- /End of search-tab --> 
  </div> <!-- /End of carousel-wrapper --> 
</div> <!-- /End of home-slider-wrapper ends here -->

<div class="home-video-wrap" style="display:none"> 
  <a href="javascript:void(0)" onclick="show_slider();" class="video-close"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" alt="business supermarket close button" width="24" /> </a>
  <div id="carousel-wrapper1">
    <div id="dragongallery1" class="stepcarousel">
      <div id='my-video'></div>
      <script type='text/javascript'></script> 
    </div> <!-- /dragongallery End -->    
  </div> <!-- /carousel-wrapper End --> 
</div>

<?php
        }
    }
}
else if(Yii::app()->urlManager->parseUrl(Yii::app()->request)=="businesslisting/businesslisting/view" || Yii::app()->urlManager->parseUrl(Yii::app()->request)=="businesslisting/businesslisting/preview_business_listing")
{
    $lid=$_GET['id'];
    if($lid=="")
    {
        $lid = Yii::app()->request->getParam('blistid');
    }
    $connection = Yii::app()->db;
    $command12 = $connection->createCommand("select * from `user_default_business_listing_images` where `user_default_business_blid`='$lid'");
    $count_val=count($command12);
    if($count_val!="")
    {      $cimage=$command12->queryRow();        if($cimage['user_default_business_listing_image']!="")        {
                    ?>
<div class="home-slider-wrap"> <!-- slider-wrapper start -->
  <div id="carousel-wrapper">
    <div id="dragongallery" class="stepcarousel">
      <div class="belt"> 
        
        <!-- Start of carousel contents -->   
        <?php
            $lid=$_GET['id'];
            if($lid=="")
            {
                $lid = Yii::app()->request->getParam('blistid');
            }
            $command1 = $connection->createCommand("select * from `user_default_business_listing` where `user_default_business_blid`='$lid'");
            $myresult1 = $command1->queryRow();
            $uid=$myresult1['user_default_business_id'];
            $command2 = $connection->createCommand("select * from `user_default_business` where `user_default_business_id`='$uid'");
            $myresult2 = $command2->queryRow();
            $uid=$myresult2['user_default_business_id'];
            $uname=$myresult2['user_default_business_username'];
            $upath=$uname."_".$uid;
            $dataReader = $connection->createCommand("SELECT * FROM user_default_business_listing_images where user_default_business_blid='$lid' order by order_id asc")->queryAll();
            foreach( $dataReader as $row ) {
                                            $img = $row['user_default_business_listing_image'];
                                            $desc = $row['user_default_business_imgdesc'];
											$sitelink = $row['user_default_business_listing_link1'];
			                        		$videolink = $row['user_default_business_listing_link2'];
                                            ?>

                                            <div class="panel">
                                              <div class="paneloverlay-wrapper">
                                                <div class="paneloverlay-top">&nbsp;</div>
                                                <div class="paneloverlay">
                                                  <p class="speech-bubble"><?php echo $desc ; ?> <?php
						  if($sitelink!="")
{
echo "<br/><a href='$sitelink'  title='' target='_blank' >Find out more ></a>";
}
else if($videolink!="")
{
echo "<br/><a href='javascript:void(0)' onclick=\"show_video('$videolink');\" title='' >Find out more ></a>";
}
?></p>
                                                  <p class="speech-bubble-sig"></p>
                                                </div> <!-- /End of paneloverlay -->          
                                                <div class="paneloverlay-bottom">&nbsp;</div>
                                              </div> <!-- /End of paneloverlay-wrapper -->         
                                              <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/blank.png">
                                              <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/users/<?php echo $upath; ?>/listing/big/<?php echo $img; ?>" alt="<?php echo $desc ; ?>" 
                                                   style="float: right;
                                                          position: relative;
                                                          overflow: hidden;
                                                          margin-top: -298px;width: 470px;
                                                          height: 290px;
                                                          margin-right: 24px;
                                                        }"/> 
                                            </div>
        <?php
                            }
                            ?>        
      </div> <!-- /End of belt -->      
    </div>  <!-- /End of dragongallery -->
    
    <p class="hideme"> <b>Current Panel:</b> <span id="statusA"></span> <b style="margin-left: 30px">Total Panels:</b> <span id="statusC"></span> </p>
    <div id="gallery-navigation">
      <p id="dragongallery-paginate" style="width: 740px"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/opencircle.png" alt="Business supermarket navigation buttons" data-over="<?php echo Yii::app()->theme->baseUrl; ?>/images/graycircle.png" data-select="<?php echo Yii::app()->theme->baseUrl; ?>/images/closedcircle.png" data-moveby="1" /> </p>
    </div> <!-- / End of gallery-navigation -->
    
    <div id="search-tab">
      <input type="text" onblur="this.value='Search site...';" onfocus="this.value='';" value="Search site..." />
      <a href="user_listing_search.php" title="Search the site" id="searchbtn"></a> </div> <!-- /End of search-tab -->     
  </div> <!-- /End of carousel-wrapper -->  
</div> <!-- /End of slider-wrapper ends here -->

<div class="home-video-wrap" style="display:none"> 
  <a href="javascript:void(0)" onclick="show_slider();" class="video-close"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" alt="business supermarket close button" width="24" /> </a>
  <div id="carousel-wrapper1">
    <div id="dragongallery1" class="stepcarousel">
      <div id='my-video'></div>
      <script type='text/javascript'></script> 
    </div> 
  </div>  <!-- /carousel-wrapper End -->  
</div>
<?php
        }
        else
        {
            ?>

<div class="home-slider-wrap"> <!-- slider-wrapper start -->
  <div id="carousel-wrapper">
    <div id="dragongallery" class="stepcarousel">
      <div class="belt"> 
        
        <!-- Start of carousel contents -->        
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">What is Business-supermarket?<br />
                A website for you to help you change your financial future.<br />
                <a href="javascript:void(0)" onclick="show_video('http://youtu.be/GQvhj2-dh-c');" title='Business supermaket designed to help you start your own business' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div> <!-- /End of paneloverlay -->
            
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div> <!-- / End of paneloverlay-wrapper --> 
          
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/what-is-dragonsnet-business-supermarket.png" alt="Worlds first business supermarket" /> </div>
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">Get free entry to our cash prize draw for your efforts every month.<br />
                <a href="javascript:void(0)" onclick="show_video('http://youtu.be/irhJrkLAZ0E');" title='Enter the Business supermarket free to enter cash prize draw' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div> <!-- /End of paneloverlay -->      
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div> <!-- /End of paneloverlay-wrapper --> 
          
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/consumer-visitor.png" alt="How Business supermarket can help the consumer or a visitor to change their financial future" /> </div>
        
        <!-- /panel -->       
        <!-- Start of carousel contents 2-->       
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">If your idea is good enough; we will put up the funding you need to take it to market.<br />
                <a href="javascript:void(0)" onclick="show_video('http://youtu.be/irhJrkLAZ0E');" title='How Business supermarket can help a new business get funding video' >Find out more ></a></p>
            </div> <!-- /End of paneloverlay -->            
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div> <!-- paneloverlay-wrapper --> 
          
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/invention-funding.png" alt="How Business supermarket can help you get funding for your business idea or new startups." /> </div>
        
        <!-- /panel -->      
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">Got a skill? Then exploit it here; become a teacher, mentor or a business partner.<br />
                <a href="javascript:void(0)" title='Get financially better off by offering your knowledge and skill to a business on Business supermarket video' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div> <!-- /paneloverlay -->        
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div>
          
          <!-- paneloverlay-wrapper -->       
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/subcontracting.png" alt="How Business supermarket can help the consumer" /> </div>
        
        <!-- /panel -->      
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">Voice your opinion and be part of the next big thing.<br />
                <a href="javascript:void(0)" title='Voice your opinion and help on Business supermarket and shape the next big thing video' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div> <!-- /paneloverlay -->          
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div> <!-- paneloverlay-wrapper -->           
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/public-opinion.png" alt="Business supermarket allows yo have your say" /> </div>     
      </div> <!-- /belt -->   
    </div>
      
    <p class="hideme"> <b>Current Panel:</b> <span id="statusA"></span> <b style="margin-left: 30px">Total Panels:</b> <span id="statusC"></span> </p>
    <div id="gallery-navigation">
      <p id="dragongallery-paginate" style="width: 740px"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/opencircle.png" alt="Business supermarket navigation buttons" data-over="<?php echo Yii::app()->theme->baseUrl; ?>/images/graycircle.png" data-select="<?php echo Yii::app()->theme->baseUrl; ?>/images/closedcircle.png" data-moveby="1" /> </p>
    </div> <!-- /gallery-navigation -->
    
    <div id="search-tab">
      <input type="text" onblur="this.value='Search site...';" onfocus="this.value='';" value="Search site..." />
     <a href="user_listing_search.php" title="Search the site" id="searchbtn"></a>
    </div> <!-- /search-tab -->     
  </div> <!-- /carousel-wrapper -->  
</div> <!-- /slider-wrapper ends here -->

<!-- slider-wrapper start -->
<div class="home-video-wrap" style="display:none">  
  <a href="javascript:void(0)" onclick="show_slider();" class="video-close"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" alt="business supermarket close button" width="24" /> </a>
  <div id="carousel-wrapper1">
    <div id="dragongallery1" class="stepcarousel">
      <div id='my-video'></div>
      <script type='text/javascript'></script> 
    </div> <!-- /dragongallery End -->   
  </div> <!-- /carousel-wrapper End -->   
</div>

<?php
        }
    }
}
else
{
    ?>

<!-- slider-wrapper start -->
<div class="home-slider-wrap">   
  <div id="carousel-wrapper">
    <div id="dragongallery" class="stepcarousel">
      <div class="belt"> 
        
        <!-- Start of carousel contents -->       
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">What do we do?<br />A website designed to help you change your financial future.<br />
                <a href="javascript:void(0)" onclick="show_video('http://youtu.be/GQvhj2-dh-c');" title='Business supermaket designed to help you start your own business' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div> <!-- /paneloverlay -->    
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div> <!-- paneloverlay-wrapper --> 
          
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/what-is-dragonsnet-business-supermarket.png" alt="Worlds first business supermarket" /> </div>
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">Get free entry to our cash prize draw for your efforts every month.<br />
                <a href="javascript:void(0)" onclick="show_video('http://youtu.be/irhJrkLAZ0E');" title='Enter the Business supermarket free to enter cash prize draw' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div> <!-- /paneloverlay -->
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div> <!-- paneloverlay-wrapper --> 
          
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/consumer-visitor.png" alt="How Business supermarket can help the consumer or a visitor to change their financial future" /> </div>
        
        <!-- /panel -->        
        <!-- Start of carousel contents 2-->      
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">If your idea is good enough; we will put up the funding you need to take it to market.<br />
                <a href="javascript:void(0)" onclick="show_video('http://youtu.be/irhJrkLAZ0E');" title='How Business supermarket can help a new business get funding video' >Find out more ></a></p>
            </div> <!-- /paneloverlay -->     
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div> <!-- paneloverlay-wrapper -->       
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/invention-funding.png" alt="How Business supermarket can help you get funding for your business idea or new startups." /> </div>
        
        <!-- /panel -->     
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">Got a skill? Then exploit it here; become a teacher, mentor or a business partner.<br />
                <a href="javascript:void(0)" title='Get financially better off by offering your knowledge and skill to a business on Business supermarket video' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div> <!-- /paneloverlay -->
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div> <!-- paneloverlay-wrapper --> 
          
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/subcontracting.png" alt="How Business supermarket can help the consumer" /> </div>
        
        <!-- /panel -->       
        <div class="panel">
          <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
              <p class="speech-bubble">Voice your opinion and be part of the next big thing.<br />
                <a href="javascript:void(0)" title='Voice your opinion and help on Business supermarket and shape the next big thing video' >Find out more ></a></p>
              <p class="speech-bubble-sig"></p>
            </div> <!-- /paneloverlay -->            
            <div class="paneloverlay-bottom">&nbsp;</div>
          </div>
          
          <!-- paneloverlay-wrapper -->           
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/public-opinion.png" alt="Business supermarket allows yo have your say" /> </div>
        
        <!-- /panel -->        
        <!-- End of carousel content --> 
        
      </div> <!-- /belt --> 
      
    </div>
    <p class="hideme"> <b>Current Panel:</b> <span id="statusA"></span> <b style="margin-left: 30px">Total Panels:</b> <span id="statusC"></span> </p>
    <div id="gallery-navigation">
      <p id="dragongallery-paginate" style="width: 740px"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/opencircle.png" alt="Business supermarket navigation buttons" data-over="<?php echo Yii::app()->theme->baseUrl; ?>/images/graycircle.png" data-select="<?php echo Yii::app()->theme->baseUrl; ?>/images/closedcircle.png" data-moveby="1" /> </p>
    </div> <!-- /gallery-navigation -->
    
    <div id="search-tab">
      <input type="text" onblur="this.value='Search site...';" onfocus="this.value='';" value="Search site..." />
     <a href="user_listing_search.php" title="Search the site" id="searchbtn"></a>
   </div> <!-- /search-tab --> 
  </div> <!-- /carousel-wrapper --> 
</div> <!-- /slider-wrapper ends here -->
<div class="home-video-wrap" style="display:none"> <!-- slider-wrapper start -->  
  <a href="javascript:void(0)" onclick="show_slider();" class="video-close"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" alt="business supermarket close button" width="24" /> </a>
  <div id="carousel-wrapper1">
    <div id="dragongallery1" class="stepcarousel">
      <div id='my-video'></div>
      <script type='text/javascript'></script> 
    </div> <!-- /dragongallery End -->    
  </div> <!-- /carousel-wrapper End --> 
</div>

<?php
}
?>
<script type="text/javascript">
    function show_video(video)
    {
        $('.home-slider-wrap').css('display','none');

        $('.home-video-wrap').fadeIn('fast');
        jwplayer('my-video').setup({
            file: video,
            image: '<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/defult-video.png',
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