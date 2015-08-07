<?php


/**
 * 
 * 
 * @name ForumClass : Common class for module configuration
 * @license Business Market
 * @author Riadh H.
 * @package Forum
 * 
 *
 */


class SearchClass extends CComponent {
    
    // Default number of comment to display
    public static $searchViewLimit = 6;
    
    // Default offset to get comment
    public static $searchViewOffset = 0;
    
    // Default order by value
    public static $searchOrderBy = 'user_default_listing_approvedate DESC';
    
    // User default value
    public static $searchCriteria = 'all';

    public  static $searchCategory = 'all';

    public static $searchLookingFor = 'all';

    public static $searchViewingLimitByCountry = 'all';

   /**
    * Format a date
    *
    * @param $date to format
    *
    * @return new date formated
    *
   */
    public static function formatDate($date) {
        
        if( empty($date) )
            return NULL;
        
        $result['time'] = date('h:i A', strtotime($date));
        
        $result['date'] = date('d/m/Y', strtotime($date));
        
        return $result;
        
    }
    
    
    
   /**
    * Get the view pagination
    *
    * @param $viewLimitValue number of comment to display
    * @param $pageSelected seleted page
    * @param $searchOrderBy Criteria Order by val of comment to display
    * @param $listingId number of comment to display
    * @param $userProfession number of comment to display 
    * 
    * @return pagination view
    *
   */
    
    public static function renderPaginationSearchNull( $viewLimitValue, $pageSelected, $searchOrderBy,$searchListingTitle,$searchuserName,$searchCategory,$searchLookingFor,$searchViewingLimitByCountry, $searchSortCondtion,$searchSortByValue) {
    /*   echo '<pre>';
       echo 'viewLimitValue'.$viewLimitValue;
        echo '$pageSelected'.$pageSelected;
        echo '$searchOrderBy'.$searchOrderBy;
        echo '$searchListingTitle'.$searchListingTitle;
        echo '$searchuserName'.$searchuserName;
        echo '$searchCategory'.$searchCategory;
        echo '$searchLookingFor'.$searchLookingFor;
        echo '$searchViewingLimitByCountry'.$searchViewingLimitByCountry;
        echo '$searchSortCondtion'.$searchSortCondtion;
        echo '$searchSortByValue'. $searchSortByValue;
        echo '</pre>';*/
        $viewLimitValue = ( isset($viewLimitValue) ) ? $viewLimitValue : SearchClass::$searchViewLimit;
        $viewOffset = ( isset($viewOffset) ) ? $viewOffset : SearchClass::$searchViewOffset;
        $searchOrderBy = ( isset($searchOrderBy) ) ? $searchOrderBy : SearchClass::$searchOrderBy;
            
        $limit = $viewLimitValue;
        $offset = $viewOffset;

        $sql = "SELECT COUNT(*) as total_post";
        $sql .= " FROM {{listing}}";
        $sql .= " WHERE ";

          $sql .= "user_default_listing_submission_status = '1'";

        if($searchListingTitle !='Nostr' && ($searchListingTitle !=''))
        {
            $sql .= ' AND user_default_listing_title="'.$searchListingTitle.'"';
        }
        if($searchCategory && $searchCategory !='all'){
            $sql .= ' AND user_default_listing_category_id='.$searchCategory.'';
        }
        if($searchLookingFor && $searchLookingFor !='all'){
            $sql .= ' AND user_default_listing_lookingfor_id='.$searchLookingFor.'';
        }
        if($searchViewingLimitByCountry && $searchViewingLimitByCountry !='all'){
            $sql .= ' AND user_default_listing_limit_viewing_id='.$searchViewingLimitByCountry.'';
        }

        if($searchUsername !='Nostr' && ($searchUsername !=''))
        {
            $Data = User::model()->findAll("user_default_username like '%".addslashes($searchUsername)."%'");
            if($Data){

                foreach($Data as $rsData){
                    $ids = $rsData->user_default_id.',';
                }
                $ids1 = rtrim($ids,',');
                $sql .= " AND user_default_profiles_id =$ids1";
            }
        }

        if($searchSortCondtion !='Nostr' && ($searchSortCondtion !='') && ($searchSortByValue !='Nostr') && ($searchSortByValue !='') ){

            if($searchSortCondtion == 'key'){

                $sql .= ' AND user_default_listing_keywords LIKE "%'.$searchSortByValue.'%"';
            }
            if($searchSortCondtion == 'listingTitle'){
                $sql .= ' AND user_default_listing_title LIKE "%'.$searchSortByValue.'%"';
            }
        }


        $sql .= " LIMIT {$offset}, {$limit}; ";

        $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
        $nbOfPost = (int) $totalPosts[0]['total_post'];

        // All posts in one page
        if( $nbOfPost <= $viewLimitValue ){
//            $paginationContent = "< Previous";
//                $paginationContent .= "<a class='active'>1</a>";
//            $paginationContent .= " Next >";
            $paginationContent = "<label style='cursor: pointer; cursor: hand;color: #808080;'> < Previous</label><a class='active' style='padding-left: 5px;'>1</a>";
            $paginationContent .= "<label style='cursor: pointer; cursor: hand;color: #808080;padding-left: 1px;'> Next ></label>";

        }else{          

            // Get the previous page if the select page isn't the first
            if( ($pageSelected != 1) ){
                
                $previousPage = (int) ($pageSelected - 1);

                $offset = (int) (($previousPage - 1) * $viewLimitValue);

                $paginationContent = "<a orderby='{$searchOrderBy}' offset='{$offset}' page='{$previousPage}'>< Previous</a>";
                
            }else{
                $paginationContent = "<label style='cursor: pointer; cursor: hand;color: #808080;'> < Previous</label>";
            }

            // Loop the pagination on depend the limit view
            $rem = $nbOfPost % $viewLimitValue;
            if($rem >0){
                $rem = 1;
            }else{
                $rem = 0;
            }
            for ($i = 1; $i <= (($nbOfPost / $viewLimitValue) + $rem); $i++) {
                
                    $activeClass =  ($i == $pageSelected ) ? "class='active'" : "";
                    
                    $offset = (int) (($i - 1) * $viewLimitValue);
                    
                    $paginationContent .= "<a orderby='{$searchOrderBy}' offset='{$offset}' page='{$i}' {$activeClass}>{$i}</a>";                    
            }          
            
            // Get the next page link
            if( ($pageSelected * $viewLimitValue) < $nbOfPost ){

                $nexPage = (int) ($pageSelected + 1);
                
                $offset = (int) (($nexPage - 1) * $viewLimitValue);               
                
                $koffset = (int) (($i - 1) * $viewLimitValue);

                $activeClass =  ($i == $pageSelected ) ? "class='active'" : "";
                
             //   $paginationContent .= "<a orderby='{$searchOrderBy}' offset='{$koffset}' {$activeClass} page='{$i}'>{$i}</a>";
                $nextPagination = "<a orderby='{$searchOrderBy}' offset='{$offset}' page='{$nexPage}'>Next ></a>";

            }else{
                $paginationContent .= "<label style='cursor: pointer; cursor: hand;color: #808080;padding-left: 1px;'> Next ></label>";
            }

            // Render the next page link
            if( ($pageSelected * $viewLimitValue) < $nbOfPost){
            
                $paginationContent .= $nextPagination;
            
            }

        }

        return $paginationContent;

    }

    public static function renderPagination( $viewLimitValue, $pageSelected, $searchOrderBy, $listingId){

        $viewLimitValue = ( isset($viewLimitValue) ) ? $viewLimitValue : SearchClass::$searchViewLimit;
        $viewOffset = ( isset($viewOffset) ) ? $viewOffset : SearchClass::$searchViewOffset;
        $searchOrderBy = ( isset($searchOrderBy) ) ? $searchOrderBy : SearchClass::$searchOrderBy;

        $limit = $viewLimitValue;
        $offset = $viewOffset;

        $sql = "SELECT COUNT(*) as total_post";
        $sql .= " FROM {{listing}}";
        $sql .= " WHERE ";

        $sql .= "  user_default_listing_title LIKE '%{$listingId}%'";
        $sql .= " OR user_default_listing_summary LIKE '%{$listingId}%'";
        $sql .= " OR user_default_listing_details LIKE '%{$listingId}%'";
        $sql .= " OR user_default_listing_fprojections LIKE '%{$listingId}%'";
        $sql .= " OR user_default_listing_want LIKE '%{$listingId}%'";
        $sql .= " OR user_default_listing_keywords LIKE '%{$listingId}%'";
        $sql .= " OR user_default_listing_question LIKE '%{$listingId}%' AND";


        $sql .= "  user_default_listing_submission_status = '1'";
        $Data = User::model()->findAll("user_default_username like '%".addslashes($keyword)."%'");

        if($Data){

            foreach($Data as $rsData){

                $ids = $rsData->user_default_id.',';

            }

            $ids1 = rtrim($ids,',');

            $sql .= " OR user_default_profiles_id =$ids1";
        }
        $sql .= " LIMIT {$offset}, {$limit}; ";

        $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
        $nbOfPost = (int) $totalPosts[0]['total_post'];


        // All posts in one page
        if( $nbOfPost <= $viewLimitValue ){

            $paginationContent = "<label style='cursor: pointer; cursor: hand; color: #808080'> < Previous</label><a class='active' style='padding-left: 5px;'>1</a>";
            $paginationContent .= "<label style='cursor: pointer; cursor: hand;color: #808080;padding-left: 1px;'> Next ></label>";

        }else{

            // Get the previous page if the select page isn't the first
            if( ($pageSelected != 1) ){

                $previousPage = (int) ($pageSelected - 1);

                $offset = (int) (($previousPage - 1) * $viewLimitValue);

                $paginationContent = "<a orderby='{$searchOrderBy}' offset='{$offset}' page='{$previousPage}'>< Previous</a>";

            }else{
                $paginationContent = "<label style='cursor: pointer; cursor: hand;color: #808080;'> < Previous</label>";
            }

            $rem = $nbOfPost % $viewLimitValue;
            if($rem >0){
                $rem = 1;
            }else{
                $rem = 0;
            }
            for ($i = 1; $i <= (($nbOfPost / $viewLimitValue) + $rem); $i++) {

                $activeClass =  ($i == $pageSelected ) ? "class='active'" : "";

                $offset = (int) (($i - 1) * $viewLimitValue);

                $paginationContent .= "<a orderby='{$searchOrderBy}' offset='{$offset}' page='{$i}' {$activeClass}>{$i}</a>";
            }

            // Get the next page link
            if( ($pageSelected * $viewLimitValue) < $nbOfPost ){

                $nexPage = (int) ($pageSelected + 1);

                $offset = (int) (($nexPage - 1) * $viewLimitValue);

                $koffset = (int) (($i - 1) * $viewLimitValue);

                $activeClass =  ($i == $pageSelected ) ? "class='active'" : "";

             //   $paginationContent .= "<a orderby='{$searchOrderBy}' offset='{$koffset}' {$activeClass} page='{$i}'>{$i}</a>";
                $nextPagination = "<a orderby='{$searchOrderBy}' offset='{$offset}' page='{$nexPage}'>Next ></a>";

            }else{
                $paginationContent .= "<label style='cursor: pointer; cursor: hand;color: #808080; padding-left: 5px'> Next ></label>";
            }

            // Render the next page link
            if( ($pageSelected * $viewLimitValue) < $nbOfPost){

                $paginationContent .= $nextPagination;

            }

        }

        return $paginationContent;

    }


}

?>