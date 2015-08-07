<?php
/* @var $this PrizeController */
/* @var $model PrizeDraw */
/* @var $form CActiveForm */

$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');
$js->registerScriptFile($baseUrl . '/js/jwplayer/jwplayer.js');
$js->registerScriptFile($baseUrl . '/js/tinymce.min.js');


$year=date('Y');
$month=date('m');
$connection = Yii::app()->db;
$command = $connection->createCommand("select * from `user_default_prize_draw` where `year`='$year' and month='$month'");
$myresult = $command->queryRow();

?>
<script type="text/javascript">
jQuery(document).ready(function(){
    
    jQuery(".chzn-select").chosen();
});
//jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
</script>

<style>
.chzn-container {
  top: 8px;
}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tooltips.css" />  
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/adminstyle.css" />
<form id="prize-form" action="" method="post">

    <div class="user_listing_search">
        <div class="close_caform"><a class="button white smallrounded" href="index.html" title="Close" >X</a></div>
        <h1 class="Blue" align="center">Members Prize Draw</h1>
        <br />
        <h2>Prize Draw details</h2>
        <br />
            <div style='margin-left: 40px;'>
<label for="Prize_year" class="required">Year : </label>                    
<input size="4" maxlength="4" id="year" style="width:50px" onfocus="getNormal('#slider_title');" name="year" type="text" value="<?php echo date("Y"); ?>"> 
                   
<label for="Prize_month" class="required">Month : </label>
<input size="2" maxlength="2" id="year" style="width:50px" onfocus="getNormal('#slider_title');" name="month" type="text" value="<?php echo date("m"); ?>">   
                 
<label for="Prize_prize_value">Prize Value ($) : </label> 
<input size="10" maxlength="10" name="prize_values" id="Prize_prize_value" type="text" value="<?php echo $myresult['prize_value']; ?>">                    

<label for="Prize_points_required">Points Required : </label> 
<input name="points_required" id="Prize_points_required" type="text" value="<?php echo $myresult['points_required']; ?>">    

<input type="hidden"  value="<?php echo $myresult['id']; ?>" name="prizeid">
          
               <span>
      <input name="savedraw" type="submit"  value="Run Prize draw" class="button red" id="run_prize_draw" style='  padding: 7px;'/>
               </span>
</div>

                <!-- <label title="year">year:</label>
                   <input type="text" name="year" value="<?php //echo date('Y');?>" style="width:50px" id="year" />
                   <label title="Month">Month:</label>
                   <input type="text" name="end_date" id="end_date" value="<?php //echo date('m');?>" style="width:100px"  placeholder="MM"/>
                   <label title="Prize Value">Prize Value ($):</label>
                   <input type="text" name="PrizeValue" id="PrizeValue" style="width:100px" />
                   <label title="Points required to enter draw">Points Require for Free Entry:</label>
                   <input type="text" name="points_required" id="points_required" style="width:100px" />
            </div>-->

</form>
   <!--<span style="float:right;">
      
    </span>-->
        <div class="clearBoth"></div>
        <br />
        <hr />
        <br />
        <h2>Winners details</h2>
        <br />
        <div>
            <label title="Date of draw">Draw date:</label>
            <input type="text" name="draw_date" id="draw_date" value="<?php echo date('d-m-Y');?>" style="width:80px" />
            <input type="hidden" name="user_trno" id="user_trno"/>
            <label title="Winners username">Username:</label>
<?php

$listData =  CHtml::listData(User::model()->findAll(array("order"=>'user_default_username asc')),'user_default_id','user_default_username');
                 echo CHtml::dropDownList('win_username','',$listData,array('prompt' => 'Please Select','class'=>'chzn-select','data-placeholder'=>'Please select','id'=>'user_default_username'));
             
?>

            <label title="Prize value">Amount won:</label>
            <input type="text" name="prize_value" id="prize_value" style="width:100px" />
            <label title="Payment ref">Payment Ref:</label>
            <input type="text" name="payment_ref" id="payment_ref" style="width:150px" />
        </div>
        <br />
        <br />
        <div id="submitQuery">
            <input type="submit" value="Enter winner into winners gallery" class="button blue" style="margin-left: -46px;padding: 7px;" name="winner_gallery" id="winner_gallery"/>
        </div>
        <div class="clearBoth"></div>


        <br />
        <table class="gernal_table" border="0" bordercolor="#fff" style="background-color:#fff" width="100%" cellpadding="1" cellspacing="2">
            <tr class="tableHeading">
                <td class="draw_date" title="Date of draw">Date of draw</td>
                <td class="username_column" title="Username of member">Username</td>
                <td class="prize_value_column" title="Prize value">Prize value</td>
                <td class="paid_out_column" title="Date paid out">Paid out date</td>
                <td class="paid_out_ref_column" title="Payment ref">PayPal Ref</td>
            </tr>
            <?php
           // $res=$Db->query("select * from  user_points where winner_flag=1 order by month");
            ?>
            <?php
            if(count($res)>0)
            {
                foreach($res as $row_user)
                {
                    $usr=$row_user['user'];
                    $result1=$Db->query("select user_default_username from user_default_user where user_default_id='$usr'");
                    $row1=$result1[0];
                    ?>
                    <tr onmouseover="ChangeColorMauve(this, true);"

                        onmouseout="ChangeColorMauve(this, false);"

                        onclick="DoNav('#');"

                        class="MauveRow">
                        <td><?php echo substr($row_user['entry_date'],8,2)."/".substr($row_user['entry_date'],5,2)."/".substr($row_user['entry_date'],0,4); ?></td>
                        <td><?php echo $row1['user_default_username'];?></td>
                        <td>$<?php echo $row_user['price'];?></td>
                        <td>-</td>
                        <td><?php echo $row_user['payment_ref'];?></td>
                    </tr>
                <?php
                }
            }//if(count($res)>0)
            else
            {
                ?>
                <tr><td colspan="5" class="MauveRow" align="center">NO RECORDS TO VIEW</td></tr>
            <?php
            }
            ?>
        </table>
        <!-- Number of records to view drop down menu -->
        <div id="page_nav">
            <table class="sl-select">
                <tr>
                    <td style="text-align: right; cursor: default;" title="Select number of records to view from the dropdown menu">View</td>
                    <td><select name="user_default_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2">
                            <option value=""></option>
                            <option>12</option>
                            <option>20</option>
                            <option>50</option>
                            <option>100</option>
                        </select></td>
                </tr>
            </table>
        </div>

        <!-- Bottom navigation menu -->

        <ul id="navlist">
            <li>&#060 Previous</li>
            <li><a href="#;">1</a></li>
            <li><a href="#;">2</a></li>
            <li><a href="#;">3</a></li>
            <li><a href="#;">4</a></li>
            <li><a href="#;">5</a></li>
            <li><a href="#;">next &#062;</a></li>
        </ul>
        <!-- /Bottom navigation menu -->

    </div>

</div><!-- form -->

<script type="text/javascript">

    function send()
    {
       // var data=jQuery("#prizedraw-form").serialize();

        var year  = jQuery('#PriceDraw_year').val();
        var month = jQuery('#PriceDraw_month').val();
        var prize_value  = jQuery('#PriceDraw_prize_value').val();
        var points_required  = jQuery('#PriceDraw_points_required').val();
        var data= 'year='+year+'&month='+month+'&prize_value='+prize_value+'&points_required='+points_required;
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("admin/prizedraw/submitprizedraw"); ?>',
            data:data,
            success:function(data){
                alert(data);
                alert('hi');
            },
            error: function(data) { // if error occured
                alert("Error occured.please try again");
            },

            dataType:'html'
        });

    }

</script>