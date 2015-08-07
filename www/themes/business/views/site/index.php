<?php 
$this->breadcrumbs = array(''); 
?>

<!-- Where business meets invention -->

<div id="main-content">
  <div id="main-title">
    <h1>Where business meets invention</h1>
  </div> <!-- /main-title -->
  
  <div id="main-copy">
    <div id="copy-column-1">
      <p style="text-align: left;"> 
        <span class="text">
          Welcome to <?php echo Yii::app()->params['domain']; ?>, the home of business invention. Whether you have a great business idea that can revolutionise the world or an individual simply looking for  extra income, we can help. To find out more 
          <a href="javascript:void(0)" onclick="show_video('https://youtu.be/p8yHWpBZqTo');"  title='How business supermarket can help you video'>
              <strong>click here &#62;&#62;</strong>
          </a> 
          <br />
        </span> 
      </p>
    </div>
    <div id="copy-column-2">
      <p style="text-align: left;"> 
          <span class="text">
            If you have a great business idea and want to find out how we can help 
            <a href="javascript:void(0)" onclick="show_video('https://youtu.be/8zwi4fMbgx4');" title='How business supermarket can help the entrepreneur video' >
                <strong>click here &#62;&#62;</strong>
            </a> 
            <br />
            Not interested in starting your own business but want to earn an income or be part of the next big thing? To find out more 
            <a href="javascript:void(0)" onclick="show_video('https://youtu.be/jpKEBElhpqw');" title='How business supermarket can help its members video' >
                <strong>click here &#62;&#62;</strong>
            </a> 
          </span> 
      </p>
    </div>
    <div class="clear"></div>
  </div> <!-- /main-copy --> 
</div> <!-- /main-content -->

<div class="clear"></div>

<?php 
    $this->renderPartial('bottom_slider');
    ?>

<div class="page_content">
  <?php if($model && $model->desc) echo $model->desc;?>
</div>