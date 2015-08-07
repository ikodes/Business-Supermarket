
/**
 * 
 * 
 * @name Engine : Engine js file
 * @license Business Market
 * @author RH
 * @package Forrum
 * 
 *
 */


jQuery(document).ready(function ($){    
       
       
        // Event for post a comment button
        $('body').on('click', '.dd_post_button', function(event){
            if( $(this).parents('form').find(".message").attr('placeholder') != ""  ){
                forum.blockWriteInForum("You must be logged in to leave a comment.");
                return false;
            }
            
            var message = $(this).parents('form').find(".message").val();
            var listingId = $(this).parents('#voice-your-opinion').attr('data-listingid');
            var commentReference = $(this).parents('form').attr('data-commentreference');
            var attachement = $(this).parents('.postBlock').find('.attachement-file');
            var thumb_attchement = $(this).parents('.postBlock').find('.attachement-thumb-file');

            
            forum.addComment(message, listingId, commentReference, event, attachement, thumb_attchement);
            
            $(this).parents('form').find(".message").val("");
            
            
        });

        // Event for post a comment button
        $('body').on('click', '.dd_sendmail_button', function(event){

            var message = $(this).parents('form').find("#message").val();
            var listingId = $(this).parents('#voice-your-opinion').attr('data-listingid');
            var commentReference = $(this).parents('form').attr('data-commentreference');
            var attachement = $(this).parents('.postBlock').find('.attachement-file');

            forum.sendMailListOwmer(message, listingId, commentReference, event, attachement);

            $(this).parents('form').find("#message").val("");


        });

        
        
        // Event for reply a comment button
        $('body').on('click', '.replpToPostComment', function(){
            
            if( $(this).hasClass("grayedOut") ){
                return false;
            }
            
            var commentId = $(this).attr('data-commentid');
            var form = $(this).parents('.dd_coment_box').find(".replyToPostCommentForm-"+commentId);
            
            if( !form.is(":visible") ){                
                form.show();                
            }else{                
                form.hide();
            }            
            
        });

    // Event for send a mail to listing owner button
    $('body').on('click', '.sendMailListOwner', function(){

        var commentId = $(this).attr('data-commentid');
        var form = $(this).parents('.dd_coment_box').find(".sendMailListOwnerForm-"+commentId);

        if( !form.is(":visible") ){
            form.show();
        }else{
            form.hide();
        }

    });
        
        // Event for like or dislike button
        $('body').on('click', '.like_button, .dislike_button', function(){            
            
            if( $(this).hasClass("grayedOut") ){
                return false;
            }
            
            var commentId = $(this).parents('.like_buuton_box').attr('data-commentid');
            var likeAction = $(this).attr('data-likeaction');
            
            forum.likeComment(commentId, likeAction);
           
        });
        
        
        // Event for update the number of comment to display
        $('body').on('click', '.user-page-nav .active-result', function(){            

            var listingId = $(this).parents('#voice-your-opinion').attr('data-listingid');
            var viewLimitValue = parseInt($(this).html());
            
            forum.UpdateViewLimit(listingId, viewLimitValue);

        });
        
        // Event for navigation (pagination)
        $('body').on('click', '.forumPageNumbers a', function(){

            var listingId = $(this).parents('#voice-your-opinion').attr('data-listingid');
            var viewLimitValue = $("#commentViewLimit").val();
            var pageSelected = $(this).attr('page');
            var viewOffsetValue = $(this).attr('offset');
            var commentOrderBy = $(this).attr('data-orderby');
            
            forum.Navigate(listingId, viewLimitValue, pageSelected, viewOffsetValue, commentOrderBy);
            
        });
   
        
        // Event for report a comment as a spam button
        $('body').on('click', '.reportAsSpam', function(){
                        
            var listingId = $(this).parents('#voice-your-opinion').attr('data-listingid');
            var commentId = $(this).attr('data-commentid');
            
            forum.reportAsSpam($(this), listingId, commentId);
            
        });
        
        // Event to prevent user action access
        $('body').on('click', '.notAllowed', function(){            
            
            forum.blockWriteInForum();
                    
            $("#light").find(".text-message").html("You must be logged in to show the attachement.");
            
            
        });
        
        // Event for attachement icon
        $('body').on('click', '.attachement-icon', function(){
            var attachment = $(this).parents('.postBlock').find('.attachement-file').attr('id');
            $('#data-'+attachment).removeAttr('style');
            $(this).parents('.attachement-div').find('.attachement-file').click();
        });
        
        // Event for attachement input
        $('body').on('change', '.attachement-file', function(){

            $(this).parents('.attachement-div').find('.attachement-icon').html(
                    "<span class='defaultCursor'>"+$(this).val()+"</span><a style='padding-left:20px;' onclick=\"$(this).parents('.attachement-div').find('.attachement-icon').html('Add attachement'); $(this).val(''); \" class='deleteAttachement'>Delete</a>"
            );
            
        });

        // Event for thumb attachement icon
        $('body').on('click', '.attachement-thumb-icon', function(){

            $(this).parents('.thumb-attachement-div').find('.attachement-thumb-file').click();

        });

        // Event for thumb attachement input
        $('body').on('change', '.attachement-thumb-file', function(){

            $(this).parents('.thumb-attachement-div').find('.attachement-thumb-icon').html(
                "<span class='defaultCursor'>"+$(this).val()+"</span><a style='padding-left:20px;' onclick=\"$(this).parents('.thumb-attachement-div').find('.attachement-thumb-icon').html('Add thumbnail image'); $(this).val('');\" class='deleteAttachement'>Delete</a>"
            );

        });
        
        
        // Event for set comment list by criteria
        $('body').on('click', '.viewByCriteria', function(){
                    
            var listingId = $(this).parents('#voice-your-opinion').attr('data-listingid');
            var viewLimitValue = $("#commentViewLimit").val();
            var commentOrderBy = $(this).attr('data-orderby');

            forum.setViewByCriteria(listingId, viewLimitValue, commentOrderBy);
            
        });        
        
        // Event for open / close comment button
        $('body').on('click', '.openCloseComments', function(){
            
            if( $(this).attr('status') == 'closed' ){
                
                $(this).parents('.dd_coment_box').find('.hiddenPostComments').each(function(){
                
                    $(this).removeClass('hiddenPostComments');
                    $(this).addClass('visiblePostComments');
                    
                });
                
                $(this).attr('status', 'opened');
                $(this).html('Close all threads<span class="classic openCloseCommentsTooltip">Close all threads</span>');
                
                
            }else{
                
                $(this).parents('.dd_coment_box').find('.visiblePostComments').each(function(){
                
                    $(this).removeClass('visiblePostComments');
                    $(this).addClass('hiddenPostComments');
                    
                });
                
                $(this).attr('status', 'closed');
                $(this).html('Open all threads<span class="classic openCloseCommentsTooltip">Open all threads</span>');
                
            }
                    
            
        });        
        
        
        var showChar = forum.showChar;
        var ellipsestext = forum.ellipsesText;
        var moretext = forum.moreText;
        var lesstext = forum.lessText;


        // Event for show more comment text button
        $('.more').each(function() {
            
            var content = $(this).html();

            if( content.length > showChar ) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="#;" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });

        // Event for show more comment text button
        $('body').on('click', '.morelink', function(){
            
            if($(this).hasClass("less")) {
                
                $(this).removeClass("less");
                $(this).html(moretext);
                
            }else {
                
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            
            return false;
            
        });
        
        
        // Event for delete a comment button
        $('body').on('click', '.deleteComment', function(){
                        
            var listingId = $(this).parents('#voice-your-opinion').attr('data-listingid');
            var commentId = $(this).attr('data-commentid');
            
            forum.deleteComment(listingId, commentId);
            
        });



        
        
        // Event for reputation select
        $('body').on('click', '.userReputation .active-result', function(){            

            var listingId = $(this).parents('#voice-your-opinion').attr('data-listingid');
            var viewLimitValue = $("#commentViewLimit").val();
            var commentOrderBy = $(this).html();
            
            $(".userReputation").find("select").find("option").each(function(){
                
                    if( $(this).html() === commentOrderBy){
                        
                        commentOrderBy = $(this).attr("value");
                        
                    }
                    
            });            
            
            forum.setViewByCriteria(listingId, viewLimitValue, commentOrderBy);

        });
        
        
        // Event for user select
        $('body').on('click', '.userProfession .active-result', function(){            

            var listingId = $(this).parents('#voice-your-opinion').attr('data-listingid');
            var viewLimitValue = $("#commentViewLimit").val();
            var commentOrderBy;
            
            if( $(".userReputation").find(".chzn-results").find(".result-selected").html() != "" ){
                
                $(".userReputation").find("select").find("option").each(function(){
                
                    if( $(this).html() === $(".userReputation").find(".chzn-results").find(".result-selected").html() ){
                        
                        commentOrderBy = $(this).attr("value");
                        
                    }
                    
                });            
                
            }
            
            forum.setViewByCriteria(listingId, viewLimitValue, commentOrderBy);

        });
        
       
        
    
});