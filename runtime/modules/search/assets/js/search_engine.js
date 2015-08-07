
var old$ = $;

jQuery(document).ready(function($){

    // Event for navigation (pagination)
    jQuery('body').on('click', '.SearchPageNumbers a', function(){
        var listingId;
        listingId = jQuery('#searchKey').val();
        var viewLimitValue = jQuery("#commentViewLimit").val();
        var pageSelected = jQuery(this).attr('page');
        var viewOffsetValue = jQuery(this).attr('offset');
        var searchOrderBy = jQuery(this).attr('orderby');

        search.Navigate(listingId, viewLimitValue, pageSelected, viewOffsetValue, searchOrderBy);
    });

    // Event for navigation (pagination)
    jQuery('.SearchNullPageNumbers a').live('click', function(){
        var pageSelected = jQuery(this).attr('page');
        var viewOffsetValue = jQuery(this).attr('offset');

        var listingTitle = 'Nostr';
        if(old$('#search_listing_title').val() != ''){
            listingTitle = old$('#search_listing_title').val();
        }
        var categoryId = old$('#categoryId').val();
        var lookingFor = old$('#lookingfor').val();
        var criteria = old$('#criteria').val();
        var viewinglimit = old$('#viewinglimit').val();
        var sortby = old$('#sortby').val();
        var searchBySortCondtion = 'Nostr';
        var viewLimitValue = old$("#viewLimitSearchKeyNull").val();

        var searchByRLValue = 'Nostr';
        if(sortby == 'relevance' ||  sortby === 'listing_title'){
            old$('span#searchbyRL').show();
            if(sortby == 'relevance'){
                searchBySortCondtion = 'key';
            }else if(sortby == 'listing_title'){
                searchBySortCondtion = 'listingTitle';
            }
            searchByRLValue = (old$('#searchbyRLValue').val()) ? old$('#searchbyRLValue').val():'';
        }
        else{
            old$('span#searchbyRL').hide();
        }
        search.NavigateSearchNull(viewLimitValue, pageSelected, viewOffsetValue, listingTitle,categoryId, lookingFor, criteria, viewinglimit, sortby,searchBySortCondtion,searchByRLValue);
    });

    // Event for update the number of comment to display
    old$('#viewLimit').on('change', function(){

        var listingId = old$('#searchKey').val();
        var viewLimitValue = old$("#viewLimit").val();


        search.UpdateViewLimit(listingId, viewLimitValue);

    });

    // Event for update the number of Searchresult to display
    old$('#viewLimitSearchKeyNull').on('change', function(){
        var listingTitle = 'Nostr';
        if(old$('#search_listing_title').val() != ''){
            listingTitle = old$('#search_listing_title').val();
        }
        var categoryId = old$('#categoryId').val();
        var lookingFor = old$('#lookingfor').val();
        var criteria = old$('#criteria').val();
        var viewinglimit = old$('#viewinglimit').val();
        var sortby = old$('#sortby').val();
        var searchBySortCondtion = 'Nostr';
        var viewLimitValue = old$("#viewLimitSearchKeyNull").val();

        //alert(viewLimitValue);
        var searchByRLValue = 'Nostr';
        if(sortby == 'relevance' ||  sortby === 'listing_title'){
            old$('span#searchbyRL').show();
            if(sortby == 'relevance'){
                searchBySortCondtion = 'key';
            }else if(sortby == 'listing_title'){
                searchBySortCondtion = 'listingTitle';
            }
            searchByRLValue = (old$('#searchbyRLValue').val()) ? old$('#searchbyRLValue').val():'';
            return;
        }
        else{
            old$('span#searchbyRL').hide();
        }

        search.UpdateViewLimitSearchKeyNull(viewLimitValue,listingTitle,categoryId, lookingFor, criteria, viewinglimit, sortby,searchBySortCondtion,searchByRLValue);

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

    jQuery('body').on('click', '#searchSubmitListingTitle , #searchSubmitUsername', function(){
        var listingTitle = 'Nostr';
        if(jQuery('#search_listing_title').val() != ''){
            listingTitle = old$('#search_listing_title').val();
        }

        var userName = 'Nostr';
        if(jQuery('#search_username').val() != ''){
            userName = old$('#search_username').val();
        }
        search.advancedSearchByListingTitle(listingTitle,userName);
    });


    jQuery('body').on('click', '#searchSubmitAll', function(){
        var listingTitle = 'Nostr';
        if(jQuery('#search_listing_title').val() != ''){
            listingTitle = jQuery('#search_listing_title').val();
        }
        var categoryId = jQuery('#categoryId').val();
        var lookingFor = jQuery('#lookingfor').val();
        var criteria = jQuery('#criteria').val();
        var viewinglimit = jQuery('#viewinglimit').val();
        var sortby =jQuery('#sortby').val();
        var searchBySortCondtion = 'Nostr';

        if(sortby == 'relevance'){
            searchBySortCondtion = 'key';
        }else if(sortby == 'listing_title'){
            searchBySortCondtion = 'listingTitle';
        }

        var searchByRL = (jQuery('#searchbyRLValue').val()) ? jQuery('#searchbyRLValue').val():'Nostr';
        //  alert('listingTitle='+listingTitle+',categoryId='+categoryId+',lookingFor='+ lookingFor+',criteria='+ criteria+',viewinglimit='+viewinglimit+',sortby='+sortby+',searchBySortCondtion='+searchBySortCondtion+',searchByRL='+searchByRL);
        search.advancedSearchByRL(listingTitle,categoryId, lookingFor, criteria, viewinglimit, sortby,searchBySortCondtion,searchByRL);
    });

    old$('#sortby').on('change', function(){

        var sortby = old$('#sortby').val();

        if(sortby == 'relevance' ||  sortby === 'listing_title'){
            $('span#searchbyRL').val('');
            old$('span#searchbyRL').show();
            return;
        }
        else{
            old$('span#searchbyRL').hide();
        }
    });
});