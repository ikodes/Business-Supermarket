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
    public static $searchOrderBy = 'drg_approvedate DESC';
    
    // User default value
    public static $searchCriteria = 'all';

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
    
    public static function renderPagination( $viewLimitValue, $pageSelected, $searchOrderBy, $listingId) {
                
        $viewLimitValue = ( isset($viewLimitValue) ) ? $viewLimitValue : SearchClass::$searchViewLimit;
        $viewOffset = ( isset($viewOffset) ) ? $viewOffset : SearchClass::$searchViewOffset;
        $searchOrderBy = ( isset($searchOrderBy) ) ? $searchOrderBy : SearchClass::$searchOrderBy;
            
        $limit = $viewLimitValue;
        $offset = $viewOffset;

        $sql = "SELECT COUNT(*) as total_post";
        $sql .= " FROM {{user_listing}}";
        $sql .= " WHERE drg_listingstatus = '1'";
        $sql .= " AND drg_category LIKE '%{$listingId}'";
        $sql .= " OR drg_profession LIKE '%{$listingId}'";
        $sql .= " OR drg_viewlimit LIKE '%{$listingId}'";
        $sql .= " OR drg_title LIKE '%{$listingId}'";
        $sql .= " OR drg_desc LIKE '%{$listingId}'";
        $sql .= " OR drg_explanation LIKE '%{$listingId}'";
        $sql .= " OR drg_businessidea LIKE '%{$listingId}'";
        $sql .= " OR drg_fprojections LIKE '%{$listingId}'";
        $sql .= " OR drg_want LIKE '%{$listingId}'";
        $sql .= " OR drg_keyword LIKE '%{$listingId}'";
        $sql .= " OR drg_mktquestion LIKE '%{$listingId}'";
        $sql .= " OR drg_company_name LIKE '%{$listingId}'";
        $sql .= " OR drg_company_address1 LIKE '%{$listingId}'";
        $sql .= " OR drg_company_address2 LIKE '%{$listingId}'";
        $sql .= " OR drg_company_address3 LIKE '%{$listingId}'";
        $sql .= " OR drg_company_town LIKE '%{$listingId}'";
        $sql .= " OR drg_company_county LIKE '%{$listingId}'";
        $sql .= " OR drg_company_zip_code LIKE '%{$listingId}'";
        $sql .= " OR drg_company_tel_no LIKE '%{$listingId}'";
        $sql .= " OR drg_company_fax_no LIKE '%{$listingId}'";


        $Data = User::model()->findAll("drg_username like '%".addslashes($keyword)."%'");

        if($Data){

            foreach($Data as $rsData){

                $ids = $rsData->drg_uid.',';

            }

            $ids1 = rtrim($ids,',');

            $sql .= " OR drg_uid ='.$ids1.'";
        }
            $sql .= " LIMIT {$offset}, {$limit}; ";

            $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
            $nbOfPost = (int) $totalPosts[0]['total_post'];

        

        // All posts in one page
        if( $nbOfPost <= $viewLimitValue ){

            $paginationContent = "<a class='active'>Page 1</a>";

        }else{          

            // Get the previous page if the select page isn't the first
            if( ($pageSelected != 1) ){
                
                $previousPage = (int) ($pageSelected - 1);
                
                $offset = (int) (($previousPage - 1) * $viewLimitValue);

                $paginationContent = "<a orderby='{$searchOrderBy}' offset='{$offset}' page='{$previousPage}'>< Previous</a>";
                
            }
            
            // Loop the pagination on depend the limit view
            for ($i = 1; $i <= ($nbOfPost / $viewLimitValue); $i++) {
                
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
                
                $paginationContent .= "<a orderby='{$searchOrderBy}' offset='{$koffset}' {$activeClass} page='{$i}'>{$i}</a>";
                $nextPagination = "<a orderby='{$searchOrderBy}' offset='{$offset}' page='{$nexPage}'>Next ></a>";

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