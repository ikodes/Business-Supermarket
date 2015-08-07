var search = search || {};
search.advancedSearchByRL = function(listingTitle,categoryId, lookingFor, criteria, viewinglimit, sortby ,searchBySortCondtion,searchByRLValue){
    jQuery.ajax({
        // The url must be appropriate for your configuration;
        // this works with the default config of 1.1.11
        url: "search/search/advancedSearchByRL",
        type: "POST",
        dataType: 'json',
        data: {
            listingTitle : listingTitle,
            categoryId : categoryId,
            lookingFor: lookingFor,
            criteria : criteria,
            viewingLimit : viewinglimit,
            sortBy : sortby,
            sortCondtion :  searchBySortCondtion,
            sortByValue : searchByRLValue
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

search.advancedSearchByListingTitle = function(listingTitle,userName){
    jQuery.ajax({
        // The url must be appropriate for your configuration;
        // this works with the default config of 1.1.11
        url: "search/search/advancedSearchByListingTitle",
        type: "POST",
        dataType: 'json',
        data: {
            listingTitle : listingTitle,
            userName : userName
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
search.advancedSearchByCondition = function(listingTitle,categoryId, lookingFor, criteria, viewinglimit, sortby , searchBySortCondtion , searchByRLValue){
    jQuery.ajax({
        // The url must be appropriate for your configuration;
        // this works with the default config of 1.1.11
        url: "search/search/advancedSearchByCondition",
        type: "POST",
        dataType: 'json',
        data: {
            listingTitle : listingTitle,
            categoryId : categoryId,
            lookingFor: lookingFor,
            criteria : criteria,
            viewingLimit : viewinglimit,
            sortBy : sortby,
            sortCondtion :  searchBySortCondtion,
            sortByValue : searchByRLValue

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

search.NavigateSearchNull = function(viewLimitValue, pageSelected, viewOffsetValue, listingTitle,categoryId, lookingFor, criteria, viewinglimit, sortby,searchBySortCondtion,searchByRLValue){
    // Get messages appropriate with the current language
    jQuery.ajax({
        // The url must be appropriate for your configuration;
        // this works with the default config of 1.1.11
        url: "search/search/NavigateSearchNull",
        type: "POST",
        dataType: 'json',
        data: {
            viewLimitValue: viewLimitValue,
            pageSelected : pageSelected,
            viewOffsetValue : viewOffsetValue,
            listingTitle : listingTitle,
            categoryId : categoryId,
            lookingFor: lookingFor,
            criteria : criteria,
            viewingLimit : viewinglimit,
            sortBy : sortby,
            sortCondtion :  searchBySortCondtion,
            sortByValue : searchByRLValue

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

search.UpdateViewLimitSearchKeyNull = function(viewLimitValue,listingTitle,categoryId, lookingFor, criteria, viewinglimit, sortby,searchBySortCondtion,searchByRLValue){
    // Get messages appropriate with the current language
    jQuery.ajax({
        // The url must be appropriate for your configuration;
        // this works with the default config of 1.1.11
        url: "search/search/UpdateViewLimitSearchKeyNull",
        type: "POST",
        dataType: 'json',
        data: {
            viewLimitValue : viewLimitValue,
            listingTitle : listingTitle,
            categoryId : categoryId,
            lookingFor: lookingFor,
            criteria : criteria,
            viewingLimit : viewinglimit,
            sortBy : sortby,
            sortCondtion :  searchBySortCondtion,
            sortByValue : searchByRLValue


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
            $(".searchPage").html("");
            $(".searchPage").html(resp.listingView);

        }

    });

}