<?php

// Put a sesion key for the admin

Yii::app()->session['adminKey'] = '0';

if( (isset($adminKey)) && ($adminKey !== "") ){

    if ( ForumClass::checkAdminKey($adminKey) ){

        Yii::app()->session['adminKey'] = '1';

    }
}

$notLogguedInText = "";

if( Yii::app()->user->isGuest ){

    $notLogguedInText = "You must be logged in to leave a comment.";

}

$listingId = $listing->drg_lid;

// Default values
if( $commentViewLimit === NULL ){

    $commentViewOffset = ForumClass::$commentViewOffset;
    $commentViewLimit = ForumClass::$commentViewLimit;
    $commentOrderBy = ForumClass::$commentOrderBy;
    $userProfession = ForumClass::$userProfession;
}

$pageSelected = ( $pageSelected !== NULL ) ? $pageSelected : 1;

$professionText = "&nbsp;"; $reputationText = "&nbsp;";

if( ($commentOrderBy == "user_reputation desc") || ($commentOrderBy == "user_reputation asc") ){

    $reputationText = "Reputation";
}

if( ($userProfession != "0") && ($pageSelected == 1) ){

    $professionText = "User";
}

$comments = Comments::getCommentsByListing($listingId, $commentViewOffset, $commentViewLimit, $commentOrderBy, $userReputation, $userProfession);

$usersStats = Comments::getUserStats($listingId);

//echo Yii::app()->user->Id;
//echo $listing->drg_uid;
// Report as spam is only permitted for the listing's owner
$reportAsSpamAllow = ( Yii::app()->user->getState('uid') == $listing->drg_uid ) ? TRUE : FALSE;

$totalComments = sizeof($comments);

?>

<script type="text/javascript" >

    // Update the total comment
    $("#totalComment").html("("+<?=Comments::getTotalComments()?>+")");

</script>

<div id="voice-your-opinion" data-listingid="<?=$listingId;?>">

        <div style="display: none;" class="white_content confirm-email" id="light">
          <div class="u-email-box" style="width: 615px !important;">
            <img src="<?=Yii::app()->theme->getBaseUrl().'/images/robot/Robot-pointing-down.png';?>" style="z-index:999999; position:relative; top:0px;" alt="">
            <div class="my-account-popup-box" style="margin-top:-38px !important;  width: 550px;">
              <a title="Close" href="javaScript:void(0)" onclick="forum.closeNotification();" class="pu-close">X</a>
              <br>
              <h2 class="Blue" style="color: #f3782c !important;">Oops.</h2>
              <h2 class="Blue text-message" style="color: #231f20 !important;">You must be logged in to continue.</h2>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <input name="cancel" id="cancel" value="Close" type="button" onclick="forum.closeNotification();" class="button black"  />
            </div>
          </div>
        </div>



    <div class="italic-font">
    <div class="pl-logo-box">

    <div id="pl-logo" class="pl-photograph" >
        <?php
        if(!empty($listing->drg_logo)){
            $userimage = Userlistingimages::model()->findAllByAttributes(array("drg_lid" => $listing->drg_lid));

            $username = User::model()->findAllByAttributes(array("drg_uid" => $listing->drg_uid));

            $ufolder = $username[0]['drg_username'].'_'.$username[0]['drg_id'];
            $img_src='upload/users/'.$ufolder.'/listing/big/'.$listing->drg_logo;
            ?>
            <img src="<?php echo Yii::app()->baseUrl;?>/<?php echo $img_src; ?>" style="height:120px;width:185px;" alt=""/>
        <?php
        }else{
            ?>
            <br/><br/>Image coming soon.
        <?php
        }
        ?>
    </div>
    <div class="headings">
            <h2><?=$listing->drg_title;?></h2>
            <label><?=$listing->drg_desc;?></label>
            <strong><?=$listing->drg_uid;?></strong>
            <p><?=$listing->drg_explanation;?></p>
    </div>
    </div>

            <div class="clear"></div>
            <div class='postBlock'>
                <form class="submit-comment" data-commentreference="0">
                        <br />
                        <textarea class="message" placeholder="<?=$notLogguedInText;?>" name="message"></textarea>
                        <!--<div class="submitBtn">--><a class="dd_post_button" title="Submit comment">Post</a><!--</div>-->
                    </form>
                <br/>
                <div class='attachement-div'>
                    <input type="file" class='attachement-file' id="attachement0" name="attachement0" data-uploadsuccess="0" data-uploadfile="null" multiple  value=""/>
                    <span class="user-attach-icon attachement-icon" data-content_title="Click to add an attachment Please note attachment must be an image or in a  PDF file format. zip & rar file can only be downloaded" style="width: 30%; margin-top: 4px;padding-left: 18px;">
                        Add attachement
                        <span class="attachement-text" style="padding-left: 17px !important;"></span>

                    </span>
                </div>
                <div class="thumb-attachement-div"  id="data-attachement0" style="display: none;">
                    <input type="file" class='attachement-thumb-file' id="thumb_attachement0" name="thumb_attachement0" data-uploadsuccess="0" data-uploadfile="null" multiple />
                    <span class="user-attach-icon attachement-thumb-icon"  style="width: 30%; margin-top: 4px;padding-left: 18px;">
                        Add thumbnail image
                        <span class="attachement-text" style="padding-left: 17px !important;"></span>

                    </span>
                </div>
            </div>

                <div class="clerboth"></div>

                <ul class="comments_button_list" style="padding-top:0px !important;">
                          <li><a href="javascript:void(0)" class="viewByCriteria" data-orderby="date_create DESC">Newest</a></li>
                          <li><a href="javascript:void(0)" class="viewByCriteria" data-orderby="date_create ASC">Oldest</a></li>
                          <li><a href="javascript:void(0)" class="viewByCriteria" data-orderby="rate DESC">Best Rated</a></li>
                          <li><a href="javascript:void(0)" class="viewByCriteria" data-orderby="rate ASC">Worst Rated</a></li>
                          <li class="userReputation">
                              <div class="userReputationText"><?=$reputationText;?></div>
                              <div class="userReputationSelect">
                                <select data-placeholder="Reputation" class="chzn-select" style="width: 120px; display: none;" tabindex="-1">
                                  <option value="">Reputation</option>
                                  <option value="user_reputation desc" <?php if( $commentOrderBy == "user_reputation desc" ) echo "selected";?>>Highest first</option>
                                  <option value="user_reputation asc" <?php if( $commentOrderBy == "user_reputation asc" ) echo "selected";?>>Lowest first</option>
                                </select>
                              </div>
                              <script type="text/javascript"> $(".chzn-select").chosen();</script>
                          </li>
                          <li class="userProfession">
                              <div class="userProfessionText"><?=$professionText;?></div>
                              <div class="userProfessionSelect">
                                <select data-placeholder="User" class="chzn-select" style="width: 150px; display: none;" tabindex="-1">

                                       <option value="0" <?php if( $userProfession == "0" ) echo "selected";?>>User status = all</option>
                                       <option value="1" <?php if( $userProfession == "1" ) echo "selected";?>>Business owner</option>
                                       <option value="2" <?php if( $userProfession == "2" ) echo "selected";?>>Consumer</option>
                                       <option value="3" <?php if( $userProfession == "3" ) echo "selected";?>>Entrepreneur</option>
                                       <option value="4" <?php if( $userProfession == "4" ) echo "selected";?>>Investor</option>
                                       <option value="5" <?php if( $userProfession == "5" ) echo "selected";?>>Other</option>
                                </select>
                               </div>
                            <script type="text/javascript"> $(".chzn-select").chosen();</script>
                          </li>
                 </ul>
                <div class="clear"></div>

    <?php if( $totalComments > 0 ){

        $i = 1;

        foreach ($comments as $commentId => $commentDetails) {

            $commentBoxClassColor = ($i%2 == 0) ? "": "even";
            $grayedOutClass = ( $commentDetails['comment']->is_spam == '1' || $commentDetails['comment']->user_id == Yii::app()->user->Id ) ? "grayedOut" : "";

            $spamCommentStyle = "";

            if( (Yii::app()->session['adminKey'] == '1') && ($commentDetails['comment']->is_spam == '1') ){

                $spamCommentStyle = "border:2px solid #ED1C24;";

            }

            ?>

                <div class="dd_coment_box <?=$commentBoxClassColor;?>" style="width:98%;<?=$spamCommentStyle?>">

                        <div class="user_image">
                            <?php
                            if($usersStats[$commentDetails['comment']->user_id]['drg_image']) {
                                $img = $usersStats[$commentDetails['comment']->user_id]['drg_image'];
                                $user_dirname = strtolower($usersStats[$commentDetails['comment']->user_id]['username']) . '_' . $usersStats[$commentDetails['comment']->user_id]['user_id'];
                                if (file_exists(Yii::app()->basePath . '/../www/upload/users/' . $user_dirname . '/images/' . $img)) {
                                    ?>
                                    <img
                                        src="<?php echo Yii::app()->createUrl('/upload/users/' . $user_dirname . '/images/' . $img); ?>"
                                        alt="<?php echo $usersStats[$commentDetails['comment']->user_id]['drg_name'] . ' ' . $usersStats[$commentDetails['comment']->user_id]['drg_surname']; ?>"
                                        width="60"/>
                                <?php
                                }else if(file_exists(Yii::app()->basePath . '/../www/upload/logo/' . $img)){ ?>
                                    <img
                                        src="<?php echo Yii::app()->createUrl('/upload/logo/'. $img); ?>"
                                        alt="<?php echo $usersStats[$commentDetails['comment']->user_id]['drg_name'] . ' ' . $usersStats[$commentDetails['comment']->user_id]['drg_surname']; ?>"
                                        width="60"/>
                                <?php } else {
                                    $img = 'avatar.jpg';
                                    ?>
                                    <img src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                                         alt="Profile picture" width="60"/>

                                <?php
                                }
                            }else{
                                $img = 'avatar.jpg';
                                ?>
                                <img src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                                     alt="Profile picture" width="60"/>
                           <?php }
                            ?>
                           <?php /*<img src="<?=Yii::app()->theme->getBaseUrl().'/images/icons/user.png';?>" width="60px"> */?></div>
                        <div class="ratting_box">
                            <span class="rating_title" data-href="#">Rating</span>
                            <span class="tooltip like_icon" data-href="#"><?=$commentDetails['comment']->likes_total;?><span class="classic">Total number of Likes</span></span>
                            <span class="tooltip dislike_icon" data-href="#"><?=$commentDetails['comment']->dislikes_total;?><span class="classic">Total number of Dislikes</span></span>
                        </div>
                        <div class="dd_coment" data-commentid="<?=$commentDetails['comment']->id;?>">

                            <ul class="dd_coment_heading" style="overflow: visible;">
                                <li><a class="tooltip" href="#" style="color:#A84793 !important; margin-right: 5px;"><?=$usersStats[$commentDetails['comment']->user_id]['username'];?><span class="classic">Username</span></a></li>
                                <li><a class="tooltip reputation" href="#" style="margin-right: 5px;" title="User reputation">*<?=abs($usersStats[$commentDetails['comment']->user_id]['user_reputation']);?><span class="classic">User reputation</span></a></li>
                                <li><a class="tooltip" href="#" style="margin-right: 5px;"><?php $o = ForumClass::formatDate($commentDetails['comment']->date_create); echo $o['date'];?><span class="classic">Date of comment</span></a></li>
                                <li><a class="tooltip" href="#" style="margin-right: 5px;"><?=$o['time'];?><span class="classic">Time of comment</span></a></li>

                                <?php

                                // There's a post comment
                                if( count($commentDetails['post_comment']) > 0 ){ ?>

                                    <li><a class="tooltip openCloseComments" data-status="closed" style="margin-right: 5px;color:#e5a404">Open all threads<span class="classic openCloseCommentsTooltip">Open all threads</span></a></li>

                                <?php }

                                if( isset($commentDetails['comment']->attachement) ) {

                                    // Display original file name
                                    $attachement = explode(".", $commentDetails['comment']->attachement);
                                    $fileNameLength = (int)((strlen($attachement[0])) + 1);

                                    $originaleFileName = substr($commentDetails['comment']->attachement, $fileNameLength);
                                    $thumbFileName = ($commentDetails['comment']->thumb_attachment) ? '<span><img src="' . Yii::app()->createUrl('/upload/comments/thumb/' . $commentDetails['comment']->thumb_attachment) . '" width="90"  /></span>' : '<span class="classic">No thumbnail</span>';
                                    $classNotAllowed = "notAllowed";
                                    $dowloadAttachementLink = "";

                                    if (!(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id))) {
                                        $classNotAllowed = "";
                                        if (file_exists(Yii::app()->basePath . '/../www/upload/comments/large/' . $commentDetails['comment']->attachement)) {
                                            $dowloadAttachementLink = "href='../forum/downloadAttachement/{$commentDetails['comment']->id}'";

                                            ?>

                                            <li>
                                                <a class="user-attach-icon tooltip attachement <?= $classNotAllowed; ?>" <?= $dowloadAttachementLink; ?>
                                                   style="margin-right: 5px;"><?= $thumbFileName; ?></a></li>

                                        <?php
                                        }
                                    }
                                }?>


                            </ul>
                            <div class="clear"></div>
                            <span class="comment more"><?=$commentDetails['comment']->message;?></span>
                            <div class="like_buuton_box" data-commentid="<?=$commentDetails['comment']->id;?>">
                                <a><span class="like_button <?=$grayedOutClass;?>" data-likeaction="like">Like</span></a>
                                <a><span class="dislike_button <?=$grayedOutClass;?>" data-likeaction="dislike">Dislike</span></a>
                            </div>
                            <div class="clear"></div>
                            <a class="floatLeft replpToPostComment <?=$grayedOutClass;?>" data-commentid="<?=$commentDetails['comment']->id;?>" style="cursor: pointer; font-size:0.8em;">Reply to post</a>

                            <?php

                            if( $commentDetails['comment']->is_spam == '1' ){

                                if( Yii::app()->session['adminKey'] == '1' ){?>

                                    <a class="floatLeft redText deleteComment" data-commentid="<?=$commentDetails['comment']->id;?>" style="font-size:0.8em; margin-left:25px;cursor: pointer;"><em>Delete comment</em></a>

                                    <a class="floatLeft  greenText sendMailListOwner" data-commentid="<?=$commentDetails['comment']->id;?>" style="font-size:0.8em; margin-left:25px;cursor: pointer;"><em>Sendmail to list owner</em></a>

                                <?php }else{
                                ?>

                                    <label class="floatLeft redText" data-commentid="<?=$commentDetails['comment']->id;?>" style="font-size:0.8em; margin-left:25px;"><em>Comment under review</em></label>

                                <?php }

                                }else{

                                    if( $reportAsSpamAllow ){?>

                                        <a class="floatLeft reportAsSpam" data-commentid="<?=$commentDetails['comment']->id;?>" style="cursor:pointer;font-size:0.8em; margin-left:25px;"><em>Report as spam</em></a>

                                        <?php

                                    }
                                }

                            ?>


                            <!-- <div class="commentLink" style="margin-right: 0px;"><span> In reply to </span> <a href="#;">Jourdan (show original message)</a></div> -->
                            <ul class="dd_social_list ">
                                <li><a href="http://www.facebook.com" class="tooltip face_book"><span class="classic">Send to my facebook account</span> </a></li>
                                <li><a href="http://www.twtter.com" class="tooltip twitter"><span class="classic">Send to my twitter account</span></a></li>
                                <li><a href="https://plus.google.com" class="tooltip googleplus"><span class="classic">Send to my googleplus account</span> </a></li>
                                <li><a href="https://www.linkedin.com" class="tooltip linked"><span class="classic">Send to my linkedin account</span></a></li>
                            </ul>
                            <div class='postBlock'>
                                <form class="submit-comment sub-text-field hiddenForm replyToPostCommentForm-<?=$commentDetails['comment']->id;?>" data-commentreference="<?=$commentDetails['comment']->id;?>">
                                        <br/><br/>
                                        <textarea class="message" placeholder="<?=$notLogguedInText;?>"></textarea>
                                       <!-- <div class="submitBtn">--><a class="dd_post_button" title="Submit comment" >Post</a><!--</div>-->
                                 <br/><br/><br/>
                               <div class='attachement-div'>
                                   <input type="file" class='attachement-file' id="attachement<?=$commentDetails['comment']->id;?>" name="attachement<?=$commentDetails['comment']->id;?>" data-uploadsuccess="0" data-uploadfile="null" multiple />
                                   <span class="user-attach-icon attachement-icon" style="width: 25%; margin-top: 8px;padding-left: 18px;" data-content_title="Click to add an attachment Please note attachment must be an image or in a  PDF file format. zip & rar file can only be downloaded">
                                       Add attachement
                                       <span class="attachement-text" style="padding-left: 17px !important;"></span>
                                   </span>
                               </div>
                                    <div class="thumb-attachement-div" id="data-attachement<?=$commentDetails['comment']->id;?>" style="display: none;">
                                        <input type="file" class='attachement-thumb-file' id="thumb_attachement0" name="thumb_attachement0" data-uploadsuccess="0" data-uploadfile="null" multiple />
                                        <span class="user-attach-icon attachement-thumb-icon"  style="width: 30%; margin-top: 4px;padding-left: 18px;">
                                            Add thumbnail image
                                            <span class="attachement-text" style="padding-left: 17px !important;"></span>

                                        </span>
                                    </div>
                               </form>

                                <form class="submit-comment sub-text-field hiddenForm sendMailListOwnerForm-<?=$commentDetails['comment']->id;?>" data-commentreference="<?=$commentDetails['comment']->id;?>">
                                    <br />
                                    <textarea class="message"></textarea>
                                    <!--<div class="submitBtn">--><a class="dd_sendmail_button" title="Submit comment" >Post</a><!--</div>-->
                                    <br/><br/><br/>
                                    <div class='attachement-div'>
                                        <input type="file" class='attachement-file' id="attachement<?=$postsComments['id'];?>" name="attachement<?=$postsComments['id'];?>" data-uploadsuccess="0" data-uploadfile="null" multiple />
                                                <span class="user-attach-icon attachement-icon" style="width: 25%; margin-top: 4px;padding-left: 18px;" data-content_title="Click to add an attachment Please note attachment must be an image or in a  PDF file format. zip & rar file can only be downloaded">
                                                    Add attachement
                                                    <span class="attachement-text" style="padding-left: 17px !important;"></span>
                                                </span>

                                    </div>

                                    <div class="thumb-attachement-div" id="data-attachement<?=$postsComments['id'];?>" style="display: none;">
                                        <input type="file" class='attachement-thumb-file' id="thumb_attachement<?=$postsComments['id'];?>" name="thumb_attachement<?=$postsComments['id'];?>" data-uploadsuccess="0" data-uploadfile="null" multiple />
                    <span class="user-attach-icon attachement-thumb-icon"  style="width: 30%; margin-top: 4px;padding-left: 18px;">
                        Add thumbnail image
                        <span class="attachement-text" style="padding-left: 17px !important;"></span>

                    </span>
                                    </div>
                                </form>
                            </div>

                        <div class="clear"></div>

                        <?php

                            $k = 1;

                            foreach ($commentDetails['post_comment'] as $postsComments) {

                                $postCommentBoxClassColor = ($k%2 == 0) ? "": "even";
                                $grayedOutClass = ( $postsComments['is_spam'] == '1' || $postsComments['user_id'] == Yii::app()->user->Id) ? "grayedOut" : "";


                                $spamCommentStyle = "";

                                if( (Yii::app()->session['adminKey'] == '1') && ($postsComments['is_spam'] == '1') ){

                                    $spamCommentStyle = "border: 2px solid #ED1C24;";

                                }

                                ?>
                                <div class="dd_coment_box <?=$postCommentBoxClassColor;?> hiddenPostComments" style="width:98%; <?=$spamCommentStyle;?>">
                                    <div class="user_image">
                                    <?php
                                    if($usersStats[$postsComments['user_id']]['drg_image']) {
                                        $img = $usersStats[$postsComments['user_id']]['drg_image'];
                                        $user_dirname = strtolower($usersStats[$postsComments['user_id']]['username']) . '_' . $usersStats[$postsComments['user_id']]['user_id'];
                                        if (file_exists(Yii::app()->basePath . '/../www/upload/users/' . $user_dirname . '/images/' . $img)) {
                                            ?>
                                            <img
                                                src="<?php echo Yii::app()->createUrl('/upload/users/' . $user_dirname . '/images/' . $img); ?>"
                                                alt="<?php echo $usersStats[$postsComments['user_id']]['drg_name'] . ' ' . $usersStats[$postsComments['user_id']]['drg_surname']; ?>"
                                                width="60"/>
                                        <?php
                                        }else if(file_exists(Yii::app()->basePath . '/../www/upload/logo/' . $img)){ ?>
                                            <img
                                                src="<?php echo Yii::app()->createUrl('/upload/logo/'. $img); ?>"
                                                alt="<?php echo $usersStats[$postsComments['user_id']]['drg_name'] . ' ' . $usersStats[$postsComments['user_id']]['drg_surname']; ?>"
                                                width="60"/>
                                        <?php } else {
                                            $img = 'avatar.jpg';
                                            ?>
                                            <img src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                                                 alt="Profile picture" width="60"/>

                                        <?php
                                        }
                                    }else{
                                        $img = 'avatar.jpg';
                                        ?>
                                        <img src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                                             alt="Profile picture" width="60"/>
                                   <?php }
                                    ?>
                               <?php /*  <img src="<?=Yii::app()->theme->getBaseUrl().'/images/icons/user.png';?>" width="60px"> */?>

                                </div>
                                <div class="ratting_box">
                                    <span class="rating_title">Rating</span>
                                    <span class="tooltip like_icon" data-href="#"><?=$postsComments['likes_total'];?><span class="classic">Total number of Likes</span></span>
                                    <span class="tooltip dislike_icon" data-href="#"><?=$postsComments['dislikes_total'];?><span class="classic">Total number of Dislikes</span></span>
                                </div>
                                <div class="dd_coment" data-commentid="<?=$postsComments['id'];?>">
                                    <ul class="dd_coment_heading">
                                        <li><a class="tooltip" href="#" style="color:#A84793 !important; margin-right: 5px;"><?=$usersStats[$postsComments['user_id']]['username'];?><span class="classic">Username</span></a></li>
                                <li><a class="tooltip reputation" href="#" style="margin-right: 5px;">*<?=abs($usersStats[$postsComments['user_id']]['user_reputation']);?><span class="classic">User reputation</span></a></li>
                                <li><a class="tooltip" href="#" style="margin-right: 5px;"><?php $u = ForumClass::formatDate($postsComments['date_create']); echo $u['date'];?><span class="classic">Date of comment</span></a></li>
                                <li><a class="tooltip" href="#" style="margin-right: 5px;"><?=$u['time'];?><span class="classic">Time of comment</span></a></li>
                                <!-- a class="tooltip" href="#" style="margin-right: 5px;">open all<span class="classic">Open ALL comments</span></a>-->
                                <!--<a class="user-attach-icon tooltip" href="#" style="margin-right: 5px;"><span class="classic">Attachment</span></a> -->

                                <?php

                                if( isset($postsComments['attachement']) ){

                                    // Display original file name
                                    $attachement = explode(".", $postsComments['attachement']);
                                    $fileNameLength = (int) ( (strlen($attachement[0])) + 1);

                                    $originaleFileName = substr($postsComments['attachement'], $fileNameLength);

                                    $thumbFileName = ($postsComments['thumb_attachment'])?'<span><img src="' . Yii::app()->createUrl('/upload/comments/thumb/' . $postsComments['thumb_attachment']) . '" width="90"  /></span>' : '<span class="classic">No thumbnail</span>';

                                     $classNotAllowed = "notAllowed";
                                    $dowloadAttachementLink = "";

                                    if( !(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id)) ){

                                        $classNotAllowed = "";
                                        if (file_exists(Yii::app()->basePath . '/../www/upload/comments/large/' . $postsComments['attachement'])) {
                                        $dowloadAttachementLink = "href='../forum/downloadAttachement/{$postsComments['id']}'";

                                    }

                                    ?>

                                    <li><a class="user-attach-icon tooltip attachement <?=$classNotAllowed;?>" <?=$dowloadAttachementLink;?> style="margin-right: 5px;"><?=$thumbFileName;?></a></li>

                                <?php } } ?>

                                    </ul>
                                    <div class="clear"></div>
                                    <span class="comment more"><?=$postsComments['message'];?></span>
                                    <div class="like_buuton_box" data-commentid="<?=$postsComments['id'];?>" style="margin-right: -22px !important;margin-top: -21px !important;">
                                        <a><span class="like_button <?=$grayedOutClass;?>" data-likeaction="like">Like</span></a>
                                        <a><span class="dislike_button <?=$grayedOutClass;?>" data-likeaction="dislike">Dislike</span></a>
                                    </div>
                                    <div class="clear"></div>
                                    <a class="floatLeft replpToPostComment <?=$grayedOutClass;?>" data-commentid="<?=$postsComments['id'];?>" style="cursor: pointer;font-size:0.8em;">Reply to post</a>

                                    <?php

                                        if( $postsComments['is_spam'] == '1' ){

                                            if( Yii::app()->session['adminKey'] == '1' ){?>

                                            <a class="floatLeft deleteComment" data-commentid="<?=$postsComments['id'];?>" style="font-size:0.8em; margin-left:25px;cursor: pointer;"><em>Delete comment</em></a>
                                                <a class="floatLeft  greenText sendMailListOwner" data-commentid="<?=$commentDetails['comment']->id;?>" style="cursor: pointer;font-size:0.8em; margin-left:25px;"><em>Sendmail to list owner</em></a>

                                        <?php

                                            }else{?>

                                                  <label class="floatLeft redText" data-commentid="<?=$postsComments['id'];?>" style="font-size:0.8em; margin-left:25px;"><em>Comment under review</em></label>

                                            <?php }


                                            }else{

                                            if( $reportAsSpamAllow ){?>

                                                <a class="floatLeft reportAsSpam" data-commentid="<?=$postsComments['id'];?>" style="cursor:pointer;font-size:0.8em; margin-left:25px;"><em>Report as spam</em></a>

                                                <?php

                                            }
                                        }

                                        ?>

                                    <div class="commentLink" style="margin-right: 0px;"><span> In reply to </span> <a href="#;"><?=$usersStats[$commentDetails['comment']->user_id]['username'];?></a></div>
                                    <ul class="dd_social_list ">
                                        <li><a href="http://www.facebook.com" class="tooltip face_book"><span class="classic">Send to my facebook account</span></a></li>
                                        <li><a href="http://www.twtter.com" class="tooltip twitter"><span class="classic">Send to my twitter account</span></a></li>
                                        <li><a href="https://plus.google.com" class="tooltip googleplus"><span class="classic">Send to my googleplus account</span></a></li>
                                        <li><a href="https://www.linkedin.com" class="tooltip linked"><span class="classic">Send to my linkedin account</span></a></li>
                                    </ul>
                                    <div class='postBlock'>
                                        <form class="submit-comment sub-text-field hiddenForm replyToPostCommentForm-<?=$postsComments['id'];?>" data-commentreference="<?=$commentDetails['comment']->id;?>">
                                            <br />
                                            <textarea class="message" placeholder="<?=$notLogguedInText;?>"></textarea>
                                            <!--<div class="submitBtn">--><a class="dd_post_button" title="Submit comment" >Post</a><!--</div>-->
                                            <br/><br/><br/>
                                            <div class='attachement-div'>
                                                <input type="file" class='attachement-file' id="attachement<?=$postsComments['id'];?>" name="attachement<?=$postsComments['id'];?>" data-uploadsuccess="0" data-uploadfile="null" multiple />
                                                <span class="user-attach-icon attachement-icon" data-content_title="Click to add an attachment Please note attachment must be an image or in a  PDF file format. zip & rar file can only be downloaded" style="width: 25%; margin-top: 4px;padding-left: 18px;">
                                                    Add attachement
                                                    <span class="attachement-text" style="padding-left: 17px !important;"></span>
                                                </span>

                                            </div>
                                            <div class="thumb-attachement-div" id="data-attachement<?=$postsComments['id'];?>" style="display: none;">
                                                <input type="file" class='attachement-thumb-file' id="thumb_attachement0" name="thumb_attachement0" data-uploadsuccess="0" data-uploadfile="null" multiple />
                                                <span class="user-attach-icon attachement-thumb-icon"  style="width: 30%; margin-top: 4px;padding-left: 18px;">
                                                    Add thumbnail image
                                                    <span class="attachement-text" style="padding-left: 17px !important;"></span>

                                                </span>
                                            </div>
                                        </form>
                                        <form class="submit-comment sub-text-field hiddenForm sendMailListOwnerForm-<?=$postsComments['id'];?>" data-commentreference="<?=$commentDetails['comment']->id;?>">
                                            <br />
                                            <textarea class="message"></textarea>
                                           <!-- <div class="submitBtn">--><a class="dd_sendmail_button" title="Submit comment" >Post</a><!--</div>-->
                                            <br/><br/><br/>
                                            <div class='attachement-div'>
                                                <input type="file" class='attachement-file' id="attachement<?=$postsComments['id'];?>" name="attachement<?=$postsComments['id'];?>" data-uploadsuccess="0" data-uploadfile="null" multiple />
                                                <span class="user-attach-icon attachement-icon" data-content_title="Click to add an attachment Please note attachment must be an image or in a  PDF file format. zip & rar file can only be downloaded" style="width: 25%; margin-top: 4px;padding-left: 18px;">
                                                    Add attachement
                                                    <span class="attachement-text" style="padding-left: 17px !important;"></span>
                                                </span>

                                            </div>
                                            <div class="thumb-attachement-div" id="data-attachement<?=$postsComments['id'];?>" style="display: none;">
                                                <input type="file" class='attachement-thumb-file' id="thumb_attachement0" name="thumb_attachement0" data-uploadsuccess="0" data-uploadfile="null" multiple />
                                        <span class="user-attach-icon attachement-thumb-icon"  style="width: 30%; margin-top: 4px;padding-left: 18px;">
                                            Add thumbnail image
                                            <span class="attachement-text" style="padding-left: 17px !important;"></span>

                                        </span>
                                            </div>
                                        </form>
                                    </div>

                                 </div>
                            </div>

                    <?php

                            $k++;

                            } ?>


                         </div>
                    </div>

                            <?php

                            $i++;

            }


     ?>
            <!-- Comment box grey -->

            <div class="clear"></div>
            <div class="user-pagination">
                    <!-- Number of records to view drop down menu -->

            <div class="user-page-nav">

                <span title="Select number of records to view from the dropdown menu">View</span>
                 <select data-placeholder=" " class="chzn-select" style="width: 60px; display: none;" tabindex="-1">
                   <option value="6"<?php if( $commentViewLimit == 6 ) echo "selected";?>>6</option>
                   <option value="12"<?php if( $commentViewLimit == 12 ) echo "selected";?>>12</option>
                   <option value="25"<?php if( $commentViewLimit == 25 ) echo "selected";?>>25</option>
                   <option value="50"<?php if( $commentViewLimit == 50 ) echo "selected";?>>50</option>
                   <option value="100"<?php if( $commentViewLimit == 100 ) echo "selected";?>>100</option>
                 </select>
                <script type="text/javascript"> $(".chzn-select").chosen();</script>
            </div>


                    <!-- Bottom navigation menu -->
                      <div class="page_numbers forumPageNumbers">
                          <?php

                            echo ForumClass::renderPagination($commentViewLimit, $pageSelected, $commentOrderBy, $listingId, $userProfession );

                          ?>

                          <input type='hidden' id='commentViewLimit' value='<?=$commentViewLimit;?>' />
                      </div>


             </div>

            <div class="clear"></div>

<?php } ?>

</div>
</div>



