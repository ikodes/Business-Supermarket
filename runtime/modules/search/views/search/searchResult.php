<?php
$SearchKey = ($searchKey !='nosearchkey') ? $searchKey :'';

// Default values
if($searchViewLimit === NULL){
    $searchViewOffset = SearchClass::$searchViewOffset;
    $searchViewLimit = SearchClass::$searchViewLimit;
    $searchOrderBy = SearchClass::$searchOrderBy;
}

$pageSelected = ( $pageSelected !== NULL ) ? $pageSelected : 1;
$searchCriteria = (isset($searchCriteria)? $searchCriteria : SearchClass::$searchCriteria);
$searchOrderBy = (isset($searchOrderBy)? $searchOrderBy : SearchClass::$searchOrderBy);

$listings = array();
$allListingData = array();
$totalSearchListings = 0;
$totalListings = 0;

if($SearchKey){
    $listings = UserDefaultListing::homeSearch($SearchKey, $searchCriteria, $searchViewOffset, $searchViewLimit, $searchOrderBy);
    $totalSearchListings = UserDefaultListing::countByHomeSearch($SearchKey, $searchCriteria,  $searchOrderBy);

    $classClose = 'close_search';
    $viewLimitId = 'viewLimit';
}
else{
    $searchuserName =(isset($searchuserName)? $searchuserName:'Nostr');
    $searchListingTitle = (isset($searchListingTitle)? $searchListingTitle:'Nostr');
    $searchCategory = (isset($searchCategory)? $searchCategory : SearchClass::$searchCategory);
    $searchLookingFor = (isset($searchLookingFor)? $searchLookingFor :SearchClass::$searchLookingFor);
    $searchViewingLimitByCountry = (isset($searchViewingLimitByCountry)? $searchViewingLimitByCountry :SearchClass::$searchViewingLimitByCountry);
    $searchSortCondtion = (isset($searchSortCondtion)? $searchSortCondtion :'Nostr');
    $searchSortByValue = (isset($searchSortByValue)? $searchSortByValue :'Nostr');

    $allListingData = UserDefaultListing::allListingData($searchListingTitle,$searchViewOffset, $searchViewLimit, $searchOrderBy , $searchCategory , $searchLookingFor , $searchViewingLimitByCountry,$searchuserName,$searchSortCondtion,$searchSortByValue);
    $totalListings = sizeof($allListingData);
    $classClose = 'close_searchKeyNull';
    $viewLimitId = 'viewLimitSearchKeyNull';
}

$listingsDetails = ($listings) ? $listings : $allListingData;
$totalSearchResults = ($totalSearchListings !=0) ? $totalSearchListings : $totalListings;


?>

<div class="searchPage" style="margin-top: -100px;">
<?php if(empty($SearchKey)){ ?>
   <center> <h1 style="font-size: 2em;color: #16aeef">refine your search</h1></center>

    <div style="width: 760px;display: inline;">
        <table width="95%">
            <tr>
                <td width="5%">&nbsp;</td>
                <td >
            <h5 class="searchlabel"> Listing title:
                    <span id="searchListingTitle"><input type="text" name="search_listing_title" id="search_listing_title" value="<?php echo ($searchListingTitle !='Nostr') ? $searchListingTitle : '' ;?>" size="50"  /></span></td>

        <td >
        <h5 class="searchlabel">username:
                <span id="searchUsername"> <input type="text" name="search_username" id="search_username" value="<?php echo ($searchuserName !='Nostr') ? $searchuserName : '' ;?>" style="width: 136px;"></span></h5></td>

                <td><div>&nbsp;</div> <span id="searchUsername"><input type="submit" id="searchSubmitAll" class="button black" value="Search" name="Search" style="margin-top: -18px;padding: 3px 12px 5px;color: #fff;border-radius: 0;font-size: 13px;"/></span></td>
            </tr>
            </table>
    </div>
    <div style="width:700px;">
        <table>

            <tr>
                <td>
                    <div class="searchlabel">Category:</div> <select class="chzn-select" name="categoryId" id="categoryId" style="width:105px !important">
                        <option value="all" >All</option>
                        <?php
                        $listingCategories = ListingCategory::model()->findAll(array('order'=>'user_default_listing_category_sort_order'));
                        foreach($listingCategories as $listingCategory):
                            ?>
                            <option value="<?php echo $listingCategory->user_default_listing_category_id;?>" <?php if( $searchCategory == $listingCategory->user_default_listing_category_id ) echo "selected";?>><?php echo $listingCategory->user_default_listing_category_name?></option>
                        <?php endforeach;?>
                    </select>
                </td>

                <td><div class="searchlabel">Looking for:</div>

                    <select class="chzn-select" name="lookingfor" id="lookingfor">
                        <?php $listingLookingFor = ListingLookingfor::model()->findAll(array('order'=>'user_default_listing_lookingfor_sort_order'));?>
                        <option value="all">All</option>
                        <?php foreach($listingLookingFor as $lookingfor):?>
                            <option value="<?php echo $lookingfor->user_default_listing_lookingfor_id;?>" <?php if( $searchLookingFor == $lookingfor->user_default_listing_lookingfor_id ) echo "selected";?>><?php echo $lookingfor->user_default_listing_lookingfor_name;?></option>
                        <?php endforeach;?>
                    </select>
                </td>

                <td><div class="searchlabel">Criteria:</div>
                    <select class="chzn-select" name="criteria" id="criteria"  style="width:150px !important">
                        <option value="all">All</option>
                       <option value="listing_investment">Listings looking for investment</option>
                        <option value="listing_auction">Listings open for auction</option>
                        <option value="listing_prize_points">Listing offering prize points</option>
                        <option value="listing_offering">Listings offering samples</option>
                        <option value="favourites">My favourites</option>
                    </select>
                </td>



                <td><div class="searchlabel" >Viewing limit:</div>
                    <select class="chzn-select" name="viewinglimit" id="viewinglimit" style="width:167px">
                        <?php $countries = Country::model()->findAll();?>
                        <option value="all">Worldwide</option>
                        <?php foreach($countries as $country):?>
                            <option value="<?php echo $country->user_default_country_id; ?>" <?php if( $searchViewingLimitByCountry == $country->user_default_country_id ) echo "selected";?>><?php echo $country->user_default_country_name;?></option>
                        <?php endforeach; ?>
                    </select>


                </td>

                <td><div class="searchlabel">Sort by:</div>

                    <select class="chzn-select" name="sortby" id="sortby" style="width:145px !important" >
                        <option value="user_default_listing_approvedate DESC">Please select</option>
                        <option value="user_default_listing_approvedate DESC" <?php if($searchOrderBy == 'user_default_listing_approvedate DESC'){?> selected <?php } ?>>Recent</option>
                        <option value="user_default_listing_approvedate ASC" <?php if($searchOrderBy == 'user_default_listing_approvedate ASC'){?> selected <?php } ?>>Oldest</option>
                        <option value="relevance" <?php if($searchOrderBy == 'relevance') echo 'selected'; ?> >Relevance</option>
                        <option value="listing_title" <?php if($searchOrderBy == 'listing_title') echo 'selected'; ?>>Listing title</option>
                    </select>
                </td>

            </tr> <tr>
                <td> </td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td> </td>
                <td>
                   <span id="searchbyRL" style="display: none;"> <input type="text" value="<?php echo ($searchSortByValue !='Nostr')?$searchSortByValue:'';?>" id="searchbyRLValue" name="searchbyRL" size="10" style="width:137px !important" > </span>
                </td></tr> </table>

    </div>
<?php }
        else{?>
    <h1 style="font-size: 2em;">Results for <span style="color:#e5a04d;"><?php echo ($searchKey != 'nosearchkey')?$searchKey:''; ?></span></h1>
    <h5 style="color:#A84793; font-size: 1em;">You searched for <span style="color:#e5a04d;"><?php echo ($searchKey != 'nosearchkey')?$searchKey:''; ?></span> -
        <?php echo $totalSearchResults;?> results found</h5>
    <div>&nbsp;</div>
        <div class="sortby">
    Sort by:&nbsp;&nbsp;
    Most Recent <input type="radio" name="searchByCriteria" id="searchByRecent"  class="searchByCriteria" value="user_default_listing_approvedate DESC" <?php if($searchOrderBy == 'user_default_listing_approvedate DESC') echo 'checked="checked"';?>  />
    Oldest       <input type="radio" name="searchByCriteria" id="searchOldest"  class="searchByCriteria"  value="user_default_listing_approvedate ASC" <?php if($searchOrderBy == 'user_default_listing_approvedate ASC') echo 'checked="checked"';  ?> />
    Relevance     <input type="radio" name="searchByCriteria" id="searchRelevance"  value="relevance" <?php if($searchCriteria=='key'){?> checked="checked" <?php } ?> />
    Listing Title    <input type="radio" name="searchByCriteria" id="searchByTitle" value="listing-title" <?php if($searchCriteria=='title'){?> checked="checked" <?php } ?> />

        <span id="search" style="margin-right: 20px">
    <input type="text"  value="" placeholder="Search site..." name="serachbykey" id="serachbykey">
   
      <span >  <input type="submit" id="searchSubmit" value="" style="margin-left:-21px"/></span>
    </span></div>
<?php } ?>
    <div class="clearfix">&nbsp;</div>
<?php if( $totalSearchResults > 0 ){
    ?>

 <?php /*<div style="margin:303px 16px 0 0;" class="<?php echo $classClose;?>"><a title="Close"
		href="<?php echo Yii::app()->getBaseUrl();?>" class="button white smallrounded">X</a></div> */ ?>
    <table  class="searchTbl" style="width:100%;">
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
                <tr class="<?php echo $class; ?>" >
                    <td style="width:20%;vertical-align: top;"><?php
                        $user = new User();
                        $userData = User::model()->findByAttributes(array('user_default_id'=>$listingData['user_default_profiles_id']));

                        $user_dirname = strtolower($userData['user_default_username'])."_".$userData['user_default_id'];
                        $img_path = Yii::app()->getBaseUrl(true).'/upload/users/'.$user_dirname.'/listing/thumb/'.$listingData['user_default_listing_thumbnail'];
                        ?>
                        <img src="<?php echo $img_path; ?>" class="searchImage image-bg" alt="Logo" /> </td>
                    <td style="width:80%;vertical-align: top;"><div class="listing_title"><a href="<?php echo Yii::app()->getBaseUrl().'/listing/view?id='.$listingData['user_default_listing_id'];?>"><?php echo $listingData['user_default_listing_title'] ?></a></div>
                     <?php   echo '<div class="listing_desc">'.$listingData['user_default_listing_what_is_it'].'</div>';

                        echo $listingData['user_default_listing_summary'];?>
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
            <?php   // if($SearchKey) {?>
            <div style="width: 100px;">
            <div style="float: left; padding-top: 5px;">
                <span title="Select number of records to view from the dropdown menu" style="color: #A84793; ">View</span>
                </div>

           <div style="float: right;">
               <select data-placeholder=" " class="chzn-select" style="width: 60px; display: none;" tabindex="-1" id="<?php echo $viewLimitId;?>" name="viewLimit">
                   <option value="6"<?php if( $searchViewLimit == 6 ) echo "selected";?>>6</option>
                   <option value="12"<?php if( $searchViewLimit == 12 ) echo "selected";?>>12</option>
                   <option value="25"<?php if( $searchViewLimit == 25 ) echo "selected";?>>25</option>
                   <option value="50"<?php if( $searchViewLimit == 50 ) echo "selected";?>>50</option>
                   <option value="100"<?php if( $searchViewLimit == 100 ) echo "selected";?>>100</option>
               </select>
               <script type="text/javascript"> $(".chzn-select").chosen();</script>
               </div></div>
            <?php //} ?>
        </div>


        <!-- Bottom navigation menu -->
        <?php $searchPageNoClass = ($SearchKey) ? 'SearchPageNumbers': 'SearchNullPageNumbers';?>
        <div class="page_numbers <?php echo $searchPageNoClass;?>" style="margin-top: -25px; margin-right: 17px;">
            <?php
            if($SearchKey) {
                echo SearchClass::renderPagination($searchViewLimit, $pageSelected, $searchOrderBy, $SearchKey);
            }
            else{

               // echo $searchViewLimit, $pageSelected, $searchOrderBy, $searchListingTitle,$searchuserName,$searchCategory,$searchLookingFor,$searchViewingLimitByCountry, $searchSortCondtion,$searchSortByValue;
                echo SearchClass::renderPaginationSearchNull($searchViewLimit, $pageSelected, $searchOrderBy, $searchListingTitle,$searchuserName,$searchCategory,$searchLookingFor,$searchViewingLimitByCountry, $searchSortCondtion,$searchSortByValue);
            }
            ?>
            <input type='hidden' id='commentViewLimit' value='<?=$searchViewLimit;?>' />
            <input type='hidden' id='searchKey' value='<?=$SearchKey;?>' />
        </div>
    </div>

    <div class="clear"></div>
<?php }else{
?>
        <div style="background-color: #FFFFFF; padding: 15px; border: 1px solid #a1919c; border-radius: 10px;">
            <div style="margin:303px 16px 0 0;" class="<?php echo $classClose;?>"><a title="Close"
                                                                        href="<?php echo Yii::app()->baseUrl;?>" class="button white smallrounded">X</a></div>
  <?php echo '<div style="font-size: small;">';
            echo 'No Search criteria to get the result</div>';
            echo '</div>';
        } ?>



</div>


<script type="text/javascript">

    $(".chzn-select").chosen();

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

    $('#sortby').on('change', function(){

        var sortby = $('#sortby').val();

        if(sortby == 'relevance' ||  sortby === 'listing_title'){
            $('span#searchbyRL').val('');
            $('span#searchbyRL').show();
            return;
        }
        else{
            old$('span#searchbyRL').hide();
        }
    });
</script>