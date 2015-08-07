<?php

$SearchKey = $searchKey;

// Default values
if($searchViewLimit === NULL){
    $searchViewOffset = SearchClass::$searchViewOffset;
    $searchViewLimit = SearchClass::$searchViewLimit;
    $searchOrderBy = SearchClass::$searchOrderBy;
}

$pageSelected = ( $pageSelected !== NULL ) ? $pageSelected : 1;
$searchCriteria = (isset($searchCriteria)? $searchCriteria : SearchClass::$searchCriteria);


$listings = UserDefaultListing::homeSearch($SearchKey, $searchCriteria, $searchViewOffset, $searchViewLimit, $searchOrderBy);
$allListingData = UserDefaultListing::allListingData($searchViewOffset, $searchViewLimit, $searchOrderBy);
$listingsDetails = ($listings) ? $listings : $allListingData;

$totalSearchListings = UserDefaultListing::countByHomeSearch($SearchKey, $searchCriteria,  $searchOrderBy);
$totalListings = sizeof($listingsDetails);

$totalSearchResults = ($totalSearchListings) ? $totalSearchListings : $totalListings;

?>
    <div class="searchPage" style="margin-top: -100px;">
    <h1 style="font-size: 2em;">Results for <span style="color:#e5a04d;"><?php echo ($searchKey != 'nosearchkey')?$searchKey:''; ?></span></h1>
    <h5 style="color:#A84793; font-size: 1em;">You searched for <span style="color:#e5a04d;"><?php echo ($searchKey != 'nosearchkey')?$searchKey:''; ?></span> -
        <?php echo $totalSearchResults;?> results found</h5>
    <div>&nbsp;</div>
        <div class="sortby">
    Sort by:&nbsp;&nbsp;
    Most Recent <input type="radio" name="searchByCriteria" id="searchByRecent"  class="searchByCriteria" value="user_default_listing_approvedate DESC" />
    Oldest       <input type="radio" name="searchByCriteria" id="searchOldest"  class="searchByCriteria"  value="user_default_listing_approvedate ASC" />
    Relevance     <input type="radio" name="searchByCriteria" id="searchRelevance"  value="relevance" <?php if($searchCriteria=='key'){?> checked <?php } ?> />
    Listing Title    <input type="radio" name="searchByCriteria" id="searchByTitle" value="listing-title" <?php if($searchCriteria=='title'){?> checked <?php } ?> />
      </div>
        <div id="search">
    <input type="text"  value="" placeholder="Search site..." name="serachbykey" id="serachbykey">
   
        <input type="submit" id="searchSubmit" value=""/>
    </div>



    <div class="clearfix">&nbsp;</div>
<?php if( $totalListings > 0 ){
    ?>
    <div style="background-color: #FFFFFF; padding: 15px; border: 1px solid #a1919c; border-radius: 10px;">
        <div style="margin:303px 16px 0 0;" class="close_caform"><a title="Close" 
		href="<?php echo Yii::app()->getBaseUrl();?>" class="button white smallrounded">X</a></div>
    <table bordercolor="#ffffff" class="searchTbl" style="width:100%;">
        <tbody>
        <?php
        if($listingsDetails) {
            foreach ($listingsDetails as $index => $listingData):
                if ($index % 2 == 0) {
                    $class = 'MauveRow';
                } else {
                    $class = 'GreyRow';
                }
                ?>
                <tr class="<?php echo $class; ?>" style="width:20%">
                    <td><?php
                        $user = new User();
                        $userData = User::model()->findByAttributes(array('user_default_id'=>$listingData['user_default_profiles_id']));

                        $user_dirname = strtolower($userData['user_default_username'])."_".$userData['user_default_id'];
                        $img_path = Yii::app()->getBaseUrl(true).'/upload/users/'.$user_dirname.'/listing/thumb/'.$listingData['user_default_listing_thumbnail'];
                        ?>
                        <img src="<?php echo $img_path; ?>" class="searchImage" alt="Logo" /> </td>
                    <td style="width:80%;valign:top"><div class="listing_title"><?php echo $listingData['user_default_listing_title'] ?></div>
                     <?php   echo '<span class="listing_desc">'.$listingData['user_default_listing_summary'].'</span>';
                        echo '<br/><br/>';
                        echo $listingData['user_default_listing_details'];?>
                    </td>
                </tr>

            <?php endforeach;
        } ?>
        </tbody>
    </table>


    <div class="clear"></div>
    <div class="user-pagination">
        <!-- Number of records to view drop down menu -->

        <div class="search-page-nav">

            <span title="Select number of records to view from the dropdown menu">View</span>
            <select data-placeholder=" " class="chzn-select" style="width: 60px; display: none;" tabindex="-1" id="viewLimit" name="viewLimit">
                <option value="6"<?php if( $searchViewLimit == 6 ) echo "selected";?>>6</option>
                <option value="12"<?php if( $searchViewLimit == 12 ) echo "selected";?>>12</option>
                <option value="25"<?php if( $searchViewLimit == 25 ) echo "selected";?>>25</option>
                <option value="50"<?php if( $searchViewLimit == 50 ) echo "selected";?>>50</option>
                <option value="100"<?php if( $searchViewLimit == 100 ) echo "selected";?>>100</option>
            </select>
            <script type="text/javascript"> $(".chzn-select").chosen();</script>
        </div>


        <!-- Bottom navigation menu -->
        <div class="page_numbers SearchPageNumbers">
            <?php
            echo SearchClass::renderPagination($searchViewLimit, $pageSelected, $searchOrderBy, $SearchKey );
            ?>
            <input type='hidden' id='commentViewLimit' value='<?=$searchViewLimit;?>' />
            <input type='hidden' id='searchKey' value='<?=$SearchKey;?>' />
        </div>
    </div>

    <div class="clear"></div>
<?php }else{
?>
        <div style="background-color: #FFFFFF; padding: 15px; border: 1px solid #a1919c; border-radius: 10px;">
            <div style="margin:303px 16px 0 0;" class="close_caform"><a title="Close"
                                                                        href="<?php echo Yii::app()->baseUrl;?>" class="button white smallrounded">X</a></div>
  <?php echo '<div style="font-size: small;">';
            echo 'No Search criteria to get the result</div>';
            echo '</div>';
        } ?>

</div>
    </div>



<script type="text/javascript">

    var search = search || {};
    var old$ = $;

    jQuery(document).ready(function($){
        // Event for navigation (pagination)
        jQuery('body').on('click', '.SearchPageNumbers a', function(){
            var listingId;
        if(jQuery('#searchKey').val()){
            listingId = jQuery('#searchKey').val();
        }else{
            listingId = 'nosearchkey';
        }

        var viewLimitValue = jQuery("#commentViewLimit").val();
        var pageSelected = jQuery(this).attr('page');
        var viewOffsetValue = jQuery(this).attr('offset');
        var searchOrderBy = jQuery(this).attr('orderby');

        search.Navigate(listingId, viewLimitValue, pageSelected, viewOffsetValue, searchOrderBy);
    });

    // Event for update the number of comment to display
        old$('#viewLimit').on('change', function(){

        var listingId = old$('#searchKey').val();
        var viewLimitValue = old$("#viewLimit").val();


        search.UpdateViewLimit(listingId, viewLimitValue);

    });


    // Event for set comment list by criteria
    jQuery('body').on('click', '.searchByCriteria', function(){


        var listingId = jQuery('#searchKey').val();
        var viewLimitValue = jQuery("#commentViewLimit").val();
        var searchOrderBy = jQuery(this).val();
        search.setViewByCriteria(listingId, viewLimitValue, searchOrderBy);

    });

        jQuery('body').on('click', '#searchSubmit', function(){
            var listingId = jQuery('#serachbykey').val();

            var searchByCriteria = jQuery('input[name=searchByCriteria]:checked').val();

            if(searchByCriteria == 'relevance' ){
                var criteria = 'key';
            }else if(searchByCriteria == 'listing-title'){
                var criteria = 'title';
            }
            search.searchByRelevanceTitle(listingId, criteria);
        });

    });

    // Navigate the comment list, useful to render the pagination
    // params : listingId
    // params : viewLimitValue number of comment to display
    // params : pageSelected
    // params : viewOffsetValue offset to start get data from database
    // params : searchOrderBy criteria to sort the comment list

    search.Navigate = function(listingId, viewLimitValue, pageSelected, viewOffsetValue, searchOrderBy){
        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "search/search/Navigate",
            type: "POST",
            dataType: 'json',
            data: {
                listingId : listingId,
                viewLimitValue: viewLimitValue,
                pageSelected : pageSelected,
                viewOffsetValue : viewOffsetValue,
                searchOrderBy : searchOrderBy
            },
            error: function(xhr,tStatus,e){

                if(!xhr){
                    console.log(" We have an error ");
                    console.log(tStatus+" "+e.message);
                }else{
                    console.log("else: "+e.message); // the great unknown
                }
            },
            success: function(resp){

                jQuery(".searchPage").html("");
                jQuery(".searchPage").html(resp.listingView);

            }
        });

    }

    search.searchByRelevanceTitle= function(listingId, criteria){
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "search/search/searchByRelevanceTitle",
            type: "POST",
            dataType: 'json',
            data: {
                listingId : listingId,
                criteria: criteria

            },
            error: function(xhr,tStatus,e){

                if(!xhr){
                    console.log(" We have an error ");
                    console.log(tStatus+" "+e.message);
                }else{
                    console.log("else: "+e.message); // the great unknown
                }
            },
            success: function(resp){

                $(".searchPage").html("");
                $(".searchPage").html(resp.listingView);

            }
        });


    }

    // Ban user action by show a bloc contain
    // params : listingId
    // params : viewLimitValue number of comment to display
    search.UpdateViewLimit = function(listingId, viewLimitValue){
        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "search/search/UpdateViewLimit",
            type: "POST",
            dataType: 'json',
            data: {
                listingId : listingId,
                viewLimitValue: viewLimitValue

            },
            error: function(xhr,tStatus,e){

                if(!xhr){
                    console.log(" We have an error ");
                    console.log(tStatus+" "+e.message);
                }else{
                    console.log("else: "+e.message); // the great unknown
                }
            },
            success: function(resp){

                $(".searchPage").html("");
                $(".searchPage").html(resp.listingView);

            }
        });

    }


    // Update the comment list throught a criteria selected by the user
    // params : listingId
    // params : viewLimitValue number of comment to display
    // params : searchOrderBy the criteria
    search.setViewByCriteria = function(listingId, viewLimitValue, searchOrderBy){
        // Get messages appropriate with the current language
        $.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "search/search/setViewByCriteria",
            type: "POST",
            dataType: 'json',
            data: {
                listingId : listingId,
                viewLimitValue: viewLimitValue,
                searchOrderBy : searchOrderBy
            },
            error: function(xhr,tStatus,e){

                if(!xhr){
                    console.log(" We have an error ");
                    console.log(tStatus+" "+e.message);
                }else{
                    console.log("else: "+e.message); // the great unknown
                }
            },
            success: function(resp){
               //alert(resp.listingView);
                $(".searchPage").html("");
                $(".searchPage").html(resp.listingView);

            }

        });

    }



    $('#search').hide();
    $("input[type=radio]").click(function(){
        var searchBy = $(this).attr('id');

        if(searchBy == 'searchRelevance' || searchBy == 'searchByTitle' ){
            $('#search').show();
        }
        else if(searchBy == 'searchByRecent' || searchBy == 'searchOldest' )
        {
            $('#search').hide();
            var orderBy = $(this).val();
            $('#search-form').submit();
        }
    });
</script>