<?php

class ListingController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('suspensed','publish','rejection','rdelete','fupdate','business_ideas','retail','industrial','science_and_technology','business_services','view','cron_day','cron_week','cron_month'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','purchaseaccess','selectlisting','update','index','delete','user_listing_step2','imageupload','user_listing_step3','user_listing_step4','listingimage','listingvideo','preview_user_listing','add_favourite','remove_favourite','my_messages','ldelete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		// $this->render('view',array(
		// 	'model'=>$this->loadModel($id),
		// ));
        $listid = $_REQUEST['id'];
        $model = $this->loadModel($listid);
        $this->pageTitle=$model->user_default_listing_title. ' - Business Supermarket';        
        //$this->metaDesc=$model->drg_desc;
        // $this->metaKeys=$model->meta_keywords;
        $adminKey = isset($_REQUEST['h']) ? $_REQUEST['h'] : "";
        
        $this->render('listing_view', array('model'=>$model, 'adminKey' => $adminKey));
	}

    public function actionAdd_favourite()
    {
        $listid = $_REQUEST['listid'];
        $model = $this->loadModel($listid);
        $user_id = Yii::app()->user->id;
        $fav_exists = Favourites::model()->findByAttributes(array('user_id'=>$user_id,'listing_id'=>$listid));
        if($fav_exists){
            Yii::app()->user->setFlash('info','The listing has already been added to Favourites!');
        }
        else{
            $new_fav = new Favourites;
            $new_fav->user_id = $user_id;
            $new_fav->listing_id = $listid;
            if($new_fav->save()){
                Yii::app()->user->setFlash('success','The listing has been added to Favourites successfully!');
            }
            else{
                Yii::app()->user->setFlash('error','Sorry! The listing could not be added to Favourites.');
            }
        }
        $this->redirect($this->createUrl('/listing/view?id='.$listid));
    }

    public function actionRemove_favourite()
    {
        $listid = $_REQUEST['listid'];
        $model = $this->loadModel($listid);
        $user_id = Yii::app()->user->id;
        
        $fav_exists = Favourites::model()->findByAttributes(array('user_id'=>$user_id,'listing_id'=>$listid));
        if(!$fav_exists){
            Yii::app()->user->setFlash('info','The listing has already been removed from Favourites!');
        }
        else{
            if($fav_exists->delete()){
                Yii::app()->user->setFlash('success','The listing has been removed from Favourites successfully!');
            }
            else{
                Yii::app()->user->setFlash('error','Sorry! The listing could not be removed from Favourites. Please try again.');
            }
        }
        $this->redirect($this->createUrl('/listing/view?id='.$listid));
    }


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	    $listid = Yii::app()->request->getParam('listid');
        $this->pageTitle='Create Listing - Business Supermarket';
        if(isset($listid) && $listid !=""){            
            $model = Createuserlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getId()."' and  user_default_listing_id ='".$listid."'");   
            $model->attributes=$_POST['Createuserlisting'];           
            
        }else {
            $model = new Createuserlisting; 
            //$model->attributes=$_POST['Createuserlisting'];
        }
        
        if(isset($_POST['Listingaddress']))
		{
	
         $model->user_default_profiles_id = Yii::app()->user->getId();
           $model->user_default_listing_date = date('d/m/Y');     
           $model->user_default_listing_submission_status="0";		   
            if($model->save())
    	    {    			        

		    if(isset($listid) && $listid !="")
			{            
            $address = Listingaddress::model()->find("user_default_listing_id = '".$listid."' ");     
            $address->attributes=$_POST['Listingaddress'];
		    $address->save();
            }
		    else
			{
            $address = new Listingaddress;
			$address->user_default_listing_id = $model->user_default_listing_id;
            $address->attributes=$_POST['Listingaddress'];
            $address->save();
            }		
    		 		 if($_POST['btnsaveforlater']==1)
					 {
					 	$this->redirect(Yii::app()->createUrl('user/myaccount/update'));
					 }
					else 
					{
	 					$this->redirect(Yii::app()->createUrl('listing/user_listing_step2/listid/'.$model->user_default_listing_id));
					}

                }
            
            
		} 
		$this->render('create',array('model'=>$model));
	}
    public function actionmy_messages(){

  $this->render('my_messages',array('model'=>$model,));
}

    public function actioncron_day(){

  $this->render('cron_day',array('model'=>$model,));
}
       public function actioncron_week(){

  $this->render('cron_week',array('model'=>$model,));
}   public function actioncron_month(){

  $this->render('cron_month',array('model'=>$model,));
} 
    
    public function actionUser_listing_step2(){
         
        
        $id = Yii::app()->request->getParam('listid');         
        $this->pageTitle='User listing step 2 - Business Supermarket'; 
             
        $model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getId()."' and  user_default_listing_id ='".$id."'");   
         
        if($_POST['Userlisting']){
            
            $model->attributes = $_POST['Userlisting'];
            
            if($model->validate()){
                
                if(Yii::app()->request->getParam('user_default_listing_fprojections') !=""){
                    foreach(Yii::app()->request->getParam('user_default_listing_fprojections') as $key => $val){
                        
                        $user_default_listing_fprojections .= str_replace(",","",$val).','; 
                    } 
                }else {
                    $user_default_listing_fprojections .= str_replace(",","",$val).',';  
                }
                $user_default_listing_fprojections = rtrim($user_default_listing_fprojections,",");                 
                $model->user_default_listing_thumbnail = Yii::app()->request->getParam('user_default_listing_thumbnail'); 
                $model->user_default_listing_financial_table_status = Yii::app()->request->getParam('user_default_listing_financial_table_status');                
                $model->user_default_listing_table_currency_code = Yii::app()->request->getParam('user_default_listing_table_currency_code'); 
                $model->user_default_listing_fprojections = $user_default_listing_fprojections;
                if($model->save()){
                    
                   //$this->redirect(Yii::app()->createUrl('listing/user_listing_step3/listid/'.$model->user_default_listing_id));
				   if($_POST['btnsaveforlater']==1)
					 {
					 	$this->redirect(Yii::app()->createUrl('user/myaccount/update'));
					 }
					else 
					{
	 					$this->redirect(Yii::app()->createUrl('listing/user_listing_step3/listid/'.$model->user_default_listing_id));
					}
                    
                }
                             
            }   
        }
               
        $this->render('user_listing_step2',array('model'=>$model,));
       
    }
    
    /**
    * Image upload from userlist step 2
    * 
    *     
    **/
    
    public function actionImageupload(){  
        
        Yii::import("ext.EAjaxUpload.qqFileUploader"); 
         
        
        $thumb = 'upload/users/'.Yii::app()->user->getState('ufolder').'/listing/thumb/';// folder for uploaded files
                
        if (!file_exists($thumb)) {
		  mkdir($thumb, 0777, true);
        }
        
        $videos = 'upload/users/'.Yii::app()->user->getState('ufolder').'/videos';// folder for uploaded files
                
        if (!file_exists($videos)) {
		  mkdir($videos, 0777, true);
        }
        
        $big = 'upload/users/'.Yii::app()->user->getState('ufolder').'/listing/big/';// folder for uploaded files
                
        if (!file_exists($big)) {
		  mkdir($big, 0777, true);
        }
        
        $folder = 'upload/users/'.Yii::app()->user->getState('ufolder').'/images/';// folder for uploaded files
                
        if (!file_exists($folder)) {
		  mkdir($folder, 0777, true);
        }
 
        
        $allowedExtensions = array("jpg",'png','gif');//array("jpg","jpeg","gif","exe","mov" and etc...
        
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        
               
        $result = $uploader->handleUpload($big); 
        
        
        //$uploader->handleUpload($thumb);
        
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 
        $fileSize = filesize($big.$result['filename']);//GETTING FILE SIZE
        
        $fileName = $result['filename'];//GETTING FILE NAME   
       
        SharedFunctions::app()->imagethumb($big.$result['filename'], $thumb.$result['filename'], 250); 
        
        
        echo $return;// it's array    
            
    }
    
    public function actionUser_listing_step3(){
        
       
        
         $id = Yii::app()->request->getParam('listid');
          $this->pageTitle='User listing step 3 - Business Supermarket';
         $model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getId()."' and  user_default_listing_id ='".$id."'"); 
         
         if($_POST['user_default_listing_image_text']){
           
            /*****************************
            if(isset($_POST['old_img_name'])){
             
                for($i=0;$i<count($_POST['old_img_name']);$i++){ 
                    
                    if($_POST['old_img_name'][$i]!=""){
                    
                        $whosloggedin = Userlistingimages::model()->find('user_default_listing_image=:imagename',array(':imagename'=>$_POST['old_img_name'][$i]) ); 
                        $whosloggedin->delete();
                        
                    } 
                }
             
             }*/
			 
            if($id!="")
		     {
               Userlistingimages::model()->deleteAll("user_default_listing_id  ='".$id."'");
             }
            
            $i=0;            
            for($i=0;$i<6;$i++){  
     
                 if($_POST['img_name'][$i]!=""){
                    
                     $Userlistingimages = new Userlistingimages;
                     $Userlistingimages->user_default_listing_image = $_POST['img_name'][$i];
                     $Userlistingimages->user_default_listing_image_text = $_POST['user_default_listing_image_text'][$i];
					 $Userlistingimages->user_default_listing_image_link2 = $_POST['user_default_listing_image_link2'][$i];
                     $Userlistingimages->user_default_listing_id =  $id;
                     $Userlistingimages->save();
                 }                
                   
            }
              
           
            /******************************/
            if(isset($_POST['drg_old_videos'])){
                $i=0;
                for($i=0;$i<count($_POST['drg_old_videos']);$i++){ 
                    
                    if($_POST['drg_old_videos'][$i] !="")
                    {   
                        $whosloggedin = Userlistingvideos::model()->find('user_default_listing_video_link=:videoname',array(':videoname'=>$_POST['drg_old_videos'][$i]) ); 
                        $whosloggedin->delete();
                    }
                     
                }
             
             } 
            
            $i=0;            
            for($i=0;$i<count($_POST['drg_videos']);$i++){ 
                    
                 if($_POST['drg_videos'][$i] !=""){    
if($_POST['drg_videos'][$i]!="1")
{	
                      
                     $Uservideo = new Userlistingvideos;            
                     $video = $_POST['drg_videos'][$i];              
                     $Uservideo->user_default_listing_video_type = "0";
                     $Uservideo->user_default_listing_video_link = $video;
                     $Uservideo->user_default_listing_id =  $id;
                     $Uservideo->save();
}
                 }   
            }
			
			
			$i=0; 
			for($i=0;$i<count($_POST['drg_youtubevideos']);$i++){ 
                    
                 if($_POST['drg_youtubevideos'][$i] !=""){ 
if($_POST['drg_youtubevideos'][$i]!="1")
{					 
                      
                     $Uservideo = new Userlistingvideos;            
                     $video = $_POST['drg_youtubevideos'][$i];              
                     $Uservideo->user_default_listing_video_type = "1";
                     $Uservideo->user_default_listing_video_link = $video;
                     $Uservideo->user_default_listing_id =  $id;
                     $Uservideo->save();
                 }   
				 }
            }
			
			
            
            
	         if($_POST['btnsaveforlater']==1)
			 {
			 	$this->redirect(Yii::app()->createUrl('user/myaccount/update'));
			 }
			else 
			{
				$this->redirect(Yii::app()->createUrl('listing/user_listing_step4/listid/'.$model->user_default_listing_id));
			}
             //$this->redirect(Yii::app()->createUrl('listing/user_listing_step4/listid/'.$model->user_default_listing_id));
        } 
         
         $this->render('user_listing_step3',array('model'=>$model,));
    }
     
	
    /**
    * Image upload from userlist step 3
    * 
    *     
    **/
    public function actionListingimage(){  
        
        Yii::import("ext.EAjaxUpload.qqFileUploader"); 
         
        
        $thumb = 'upload/users/'.Yii::app()->user->getState('ufolder').'/listing/thumb/';// folder for uploaded files
                
        if (!file_exists($thumb)) {
		  mkdir($thumb, 0777, true);
        }
        
        $videos = 'upload/users/'.Yii::app()->user->getState('ufolder').'/videos/';// folder for uploaded files
                
        if (!file_exists($videos)) {
		  mkdir($videos, 0777, true);
        }
        
        $big = 'upload/users/'.Yii::app()->user->getState('ufolder').'/listing/big/';// folder for uploaded files
                
        if (!file_exists($big)) {
		  mkdir($big, 0777, true);
        }
        
        $folder = 'upload/users/'.Yii::app()->user->getState('ufolder').'/images/';// folder for uploaded files
                
        if (!file_exists($folder)) {
		  mkdir($folder, 0777, true);
        }
 
        
        $allowedExtensions = array("jpg",'png','gif');//array("jpg","jpeg","gif","exe","mov" and etc...
        
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        
               
        $result = $uploader->handleUpload($big);
        
        //$uploader->handleUpload($thumb);
        
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 
        $fileSize = filesize($big.$result['filename']);//GETTING FILE SIZE
        
        $fileName = $result['filename'];//GETTING FILE NAME   
        
        SharedFunctions::app()->imagethumb($big.$result['filename'], $thumb.$result['filename'], 140);   
        
        echo $return;// it's array
        
            
    }
    
     public function actionUser_listing_step4(){
         
        
        $id = Yii::app()->request->getParam('listid');   
		
         $this->pageTitle='User listing step 4 - Business Supermarket';
		 
        $model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");   
        
        if(isset($_POST['Userlisting']['user_default_listing_question'])){
             
            $model->user_default_listing_question = $_POST['Userlisting']['user_default_listing_question'];
			
            $model->user_default_listing_notification_frequency = $_POST['user_default_listing_notification_frequency'];			
			
			//$model->user_default_listing_submission_status="0";
			
			            if($model->save()){   
                
                     if($_POST['btnsaveforlater']==1)
						 
					 {
					 	$this->redirect(Yii::app()->createUrl('user/myaccount/update'));
						
					 } 
                
                if($_POST['saveforlater']){ 
					
					$model_user = User::model()->find("user_default_id='".Yii::app()->user->getState('uid')."'");
					
			    	$sstatus="Saved for later";
					
                    $to = $model_user['user_default_email'];
					
					$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing/fupdate/listid/".$model->user_default_listing_id.'" target="_blank" >here >> </a>';
					
					$template =  MailTemplate::getTemplate('Listing_save_for_later');
					
					$subjectcc=$model['user_default_listing_title']." has been successfully saved for later";
					
                    $ltitle="<i>".$model['user_default_listing_title']."</i>";
					
	   		        $ldate="<i>".$model['user_default_listing_date']."</i>";
					
			        $lstatus="<i>".$sstatus."</i>";
					
			        $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($ltitle),
						'{{#USERNAME#}}'=>ucwords($model_user['user_default_first_name'] .' '. $model_user['user_default_surname']),
                        '{{#LISTINGDATE#}}'=>ucwords($ldate),
						'{{#LISTINGSTATUS#}}'=>ucwords($lstatus),
						'{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id)                        
                    );
					
					$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
					
                    $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body); 
                            
						
                            $this->redirect(Yii::app()->createUrl('user/myaccount/update'));
							
                            die;                            
                   
                }
				
				else if($_POST['save']){
                  
							$model_user = User::model()->find("user_default_id='".Yii::app()->user->getState('uid')."'");
				                            
                            $to = $model_user['user_default_email'];
							
						    $lid=$model->user_default_listing_id;
							
							$status=$model->user_default_listing_submission_status;

							$rp=$model->user_default_listing_notification_frequency;

							if($status=="1")

							{

							$stat="published";

							$from1=date_create(date('Y-m-d'));

							$to1=date_create($myresult1['user_default_listing_approvedate']);

							$diff=date_diff($to1,$from1);

							$da = $diff->format('%R%a days');
/*
$command1 = $connection->createCommand("select * from `drg_comments` where `listing_id`='$lid'");
$count_val2=count($command1);

$uid=Yii::app()->user->getState('uid');
$command2 = $connection->createCommand("select * from `drg_banner_ads` where `drg_user_id`='$uid'");
$count_val22=count($command2);

$command3 = $connection->createCommand("select * from `drg_like_comment` where `user_id`='$uid'");
$count_val33=count($command3);
*/


							$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."view?id=".$model->user_default_listing_id.'" target="_blank" >here >> </a>';

							$template =  MailTemplate::getTemplate('user_listing_report');

							$subjectcc=" Listing ".$myresult1['user_default_listing_title']." ".$rp." update report ";


							$string = array('{{#LISTINGTITLE#}}'=>ucwords($myresult1['user_default_listing_title']),
                        '{{#USERNAME#}}'=>ucwords($model_user['user_default_first_name'].' '.$model_user['user_default_surname']),
                        '{{#LISTINGDATE#}}'=>ucwords($myresult1['user_default_listing_date']),
						'{{#LISTINGSTATUS#}}'=>ucwords($stat),
						'{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id),
						 '{{#DA#}}'=>ucwords($da),
                        '{{#PV#}}'=>ucwords($count_val2),
						'{{#VOTES#}}'=>ucwords($count_val33),
						'{{#COMMENTS#}}'=>ucwords($count_val2),
						'{{#MESSAGES#}}'=>ucwords($count_val22),
						'{{#STATUS#}}'=>ucwords($rp)
			 
							);

							$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);

							$result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);  

							}

							else

							{


							if($status=="0")

							{

							$stat ="Waiting admin approval and publication";

							}

							else if($status=="1")

							{

							$stat ="Published";

							}

							else if($status=="2")

							{

							$stat ="Suspended";

							}

							else if($status=="3")

							{

							$stat ="Deleted";

							}

							else if($status=="4")

							{

							$stat ="Restored";

							}

							else if($status=="4")

							{

							$stat ="Permenant Deleted";

							}
					
							$template =  MailTemplate::getTemplate('user_listing_submit'); 
 
                            $yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."fupdate"."/listid/".$model->user_default_listing_id.'" target="_blank" >here >> </a>';
			 
							$ltitle="<i>".$model['user_default_listing_title']."</i>";
	   		        
							$ldate="<i>".$model['user_default_listing_date']."</i>";
			       
							$lstatus="<i>".$stat."</i>";
   
							$string = array(
							'{{#LISTINGTITLE#}}'=>ucwords($ltitle),
							'{{#USERNAME#}}'=>ucwords($model_user['user_default_first_name'].' '.$model_user['user_default_surname']),
							'{{#LISTINGDATE#}}'=>ucwords($ldate),
							'{{#LISTINGSTATUS#}}'=>ucwords($lstatus),
							'{{#LLINK#}}'=>ucwords($yii_user_request_id),
                  
							);
					
					        $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
							$result =  SharedFunctions::app()->sendmail($to,$template->template_subject,$body);  
							
}


                            
                            $this->render("successmessage",$model);
                            die;
                            
                    
                } 
                
              $this->redirect(Yii::app()->createUrl('listing/preview_user_listing/listid/'.$model->user_default_listing_id)); 
            }
            
        }
              
        $this->render('user_listing_step4',array('model'=>$model,));
       
    }
    
    public function actionPreview_user_listing(){
         
        
        $id = Yii::app()->request->getParam('listid');         
         $this->pageTitle='Preview listing - Business Supermarket';
        $model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");   
         
        $this->render('preview_user_listing',array('model'=>$model,));
        
    }
	
		  public function actionListingvideo(){  
     
        // Getting a unique name of our new video file based on time stamp using microtime
        $time=microtime();
        $time=str_replace(".","",$time);
        $time=str_replace(" ","",$time);
        
        $quality =6000;
        $name=$time; // this will be a new unique name for our video to prevent overwritng  of existing videos -- 
        //note: you can change the way of naming your videos
        $_SESSION['name']=$name;
        
        // setting up max video size - by default php is set to 2 MB
       // $max_upload_size = 600*1024*1024; // size is in MB
        
      
        
        // define a folders to store converted temp and converted vids
       $path = $_SERVER['DOCUMENT_ROOT'].'/';  
        $temp_dir=$path."temp/";
        $log=$path."log/";
        //$converted_vids=$path."converted_vids/";
        $converted_vids = $path."upload/users/".Yii::app()->user->getState('ufolder')."/videos/";
        
        $_SESSION['converted_vids']=$converted_vids;
        $_SESSION['temp_dir']=$temp_dir;
        // if those directotires don't exist - create them and give them read/write permissions
        if(!is_dir($temp_dir)) mkdir($temp_dir, 0777); 
        if(!is_dir($log)) mkdir($log, 0777); 
        
        if(!is_dir($converted_vids)) mkdir($converted_vids, 0777); 
       
        if(isset($_FILES['file_vid']) && !empty($_FILES['file_vid']['name'])) 
        { 
        	// Checking extension of selected video - these extension are suported by ffmpeg
        
        	$allowedExtensions = array("3gp","avi","mpg","mpeg","mpe4","mov","m4a","mj2","flv","wmv","mp4","ogg","webm");
        	foreach ($_FILES as $file) 
        	{
        		if ($file['tmp_name'] > '') 
        		{
        			$ext = @end(@explode(".", $file['name']));
        			if (!in_array($ext,$allowedExtensions)) 
        			{
        				
        				echo "<div class='red'>".$file['name']." is an invalid file type!<br>Supported files are:<br><strong>3gp,avi,mpg,mpeg,mpe4,mov,m4a,mj2,flv,wmv,mp4,ogg,webm</strong><br></div>";
        				echo "<div><br><a class='button black'>Back to upload video</a></div>";		
        				exit;
        			}
        		}			 
        	} 
        		
        	// get file size and convert it to MB's
        	
        	$filesize=$_FILES["file_vid"]["size"];
        	//$filesize = round(($filesize/1048576),2);
        	 
             
            
        	//get extension
        	$file_name=basename( $_FILES['file_vid']['name']) ;
        	$filename=$temp_dir.$file_name;
        	$extension = substr($file_name, strrpos($file_name, "."));
        	$extension = strtolower($extension);
        	
        	// checking the size of uploading video
        		
        /*	if ($filesize > $max_upload_size) 
        	{	
        
        		echo "<div class='red'>Your video is to big(".$filesize." MB)! <br>Max video size is set to ".$max_upload_size." MB<br> Upload failed.<br></div>";
        		echo "<div><br><a class='button black' >Back to upload video</a></div>";
        		exit;
        	}*/
        			 
        	//echo "Size of your video: ".$filesize." MB<br>";
        
        	//everething is OK  -> move uploaded file
        	move_uploaded_file($_FILES["file_vid"]["tmp_name"],$temp_dir . $_FILES["file_vid"]["name"]);
        	
        	// rename our file to microtime name + extension of video - this will make easier for ffmpeg to read this uploaded file before converting(preventing video names with special characters)
        	
        	rename($filename, $temp_dir.$name.$extension); // this is new name for our video, something like 0342731001282903919.avi
        	
        	$video_to_convert=$temp_dir.$name.$extension;
        	$_SESSION['video_to_convert']=$video_to_convert;
        	
        	$type=$_POST['type'];
        	if (isset($_POST['size'])) {$size=$_POST['size'];} 
        	if (isset($_POST['quality'])) {$quality=$_POST['quality'];}
        	if (isset($_POST['audio'])) {$audio=$_POST['audio'];}
        
        	if($type=="webm" && $audio=="11025"){$audio="22050";$type="webm"; }// for webm  audio can not be 11050
        	if($type=="ogg" && $audio=="11025"){$audio="22050"; $type="ogg"; }// for ogg  audio can not be 11050
        
        	$converted_vids=$_SESSION['converted_vids'];
        	$temp_dir=$_SESSION['temp_dir'];
        	$name=$_SESSION['name'];
        	$_SESSION['type']=$type; 
        	
        	//define a settings for converting to specific video format
        	
        	if($type=="flv"){ 
        	   
        	   //$call="ffmpeg/ffmpeg.exe -i ".$_SESSION['video_to_convert']." -vcodec flv -f flv -r 30 -b ".$quality." -ab 128000 -ar ".$audio." -s ".$size." ".$converted_vids.$name.".".$type." -y 2> log/".$name.".txt";
                $call="ffmpeg -i ".$_SESSION['video_to_convert']." -vcodec flv -f flv -r 30 -b ".$quality." -ab 128000 -ar ".$audio." -s ".$size." ".$converted_vids.$name.".".$type." -y 2> log/".$name.".txt";
           
            }
            
        	chmod($converted_vids.$name, 0777); 
        	/* START CONVERTING */
        		
        	$convert = (popen("start /b ".$call , "r")); //for window
        	$convert = (popen($call." >/dev/null &" , "r")); //for the linux
        	
        	
        
        	pclose($convert);
        		
        	// define sessions
        
        	$_SESSION['name']=$name;
        	$_SESSION['dest_file']=$converted_vids.$name; 
        	  
         
        	/*
        	// process to move the file from temp folder to user folder
        	$UPLOAD_PATH_ORG = getcwd().'/';
        	$user_video_path = $UPLOAD_PATH_ORG ."upload/users/".Yii::app()->user->getState('ufolder')."/videos/";
            $user_video_path = str_replace( 'video-upload/','',$user_video_path); 
            
            
            
            $source_file_path=$UPLOAD_PATH_ORG."temp/".$name.$extension;
            $destination_file_path=$user_video_path.$name.$extension;
            
            echo "\nsource :".$source_file_path;
            echo "\n ok :".$destination_file_path;
              
            
            if(copy($UPLOAD_PATH_ORG."temp/".$name.$extension,$destination_file_path))
            {		
        		//unlink($UPLOAD_PATH_ORG."temp/".$name.$extension);		
        	}
          	echo "upload/users/".Yii::app()->user->getState('ufolder')."/videos/".$name.$extension;
            */
           	echo $name.'.'.$type;
        	exit; 
    }
          
          
        
     } 
    
    
   
    
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        
        $model1 = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."'");
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Userlisting']))
		{
			$model->attributes=$_POST['Userlisting'];
            $model->user_default_profiles_id = Yii::app()->user->getState('uid');
			if($model->save())
			{
			      $this->redirect(array('user_listing_step2'));
			}	
            //$this->redirect(array('view','id'=>$model->user_default_listing_id));
		}

		$this->render('create',array(
			'model'=>$model1,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */	 
	 
	 public function actionldelete()

	 {		    
	 
	 $id = Yii::app()->request->getParam('listid');	
	 
	 $model=$this->loadModel($id);
	 
	 $user_details = User::model()->findAllByAttributes(array("user_default_id"=>$model->user_default_profiles_id));
	 
	 $user_id = $user_details[0]['user_default_id'];
	 
	 $user_name = $user_details[0]['user_default_username'];
	 
	 $folder=$user_name.'_'.$user_id;
	 
	 $path =  $_SERVER['DOCUMENT_ROOT'].'/'; 
	 
	 $temp_folder = $path.'temp/';
			
	 $userfolder = $path.'upload/users/'.$folder.'/';
	 
	 $logo = $model->user_default_listing_thumbnail;
	 
	 $bigimgpath = $userfolder.'listing/big/'.$logo;
	 
	 $thumbimgpath = $userfolder.'listing/thumb/'.$logo;
	 
	 unlink($bigimgpath);
	 
	 unlink($thumbimgpath);
	 
	 $attribs = array('user_default_listing_id'=>$id);
	 
     $criteria = new CDbCriteria(array('order'=>'iuser_default_listing_video_id ASC'));
	 
	 $vids = Userlistingvideos::model()->findAllByAttributes($attribs, $criteria);
	 
	 foreach ($vids as $videos)
	 {
			
			$vid=$videos->user_default_listing_video_link;
			
			$mp4vid = str_replace("flv","mp4",$vid);
			
			$videopath=$userfolder."videos/".$vid; 
			
			$tempvideopath=$temp_folder.$mp4vid; 
			
			unlink($videopath);
	 }
	 
	 $attribs1 = array('user_default_listing_id'=>$id);
	 
     $criteria1 = new CDbCriteria(array('order'=>'user_default_listing_image_id ASC'));
	 
	 $imgs = Userlistingimages::model()->findAllByAttributes($attribs1, $criteria1);
	 
	 foreach ($imgs as $images)
	 {
			
			$img=$images->user_default_listing_image;
			
		    $bigimgpath1 = $userfolder.'listing/big/'.$img;
	 
	        $thumbimgpath1 = $userfolder.'listing/thumb/'.$img;
			
		    unlink($bigimgpath1);
	 
	        unlink($thumbimgpath1);
	 }
	 
     $query = "delete from `user_default_listing_images` where `user_default_listing_id` = :date";
	 
     $command = Yii::app()->db->createCommand($query);
	 
     $command->execute(array('date' => $id));

     $query1 = "delete from `user_default_listing_videos` where `user_default_listing_id` = :date1";

	 $command1 = Yii::app()->db->createCommand($query1);
 
     $command1->execute(array('date1' => $id));
	 
	 $query2 = "delete from `user_default_listing_addresses` where `user_default_listing_id` = :date2";

	 $command2 = Yii::app()->db->createCommand($query2);
 
     $command2->execute(array('date2' => $id));
						
     $model->delete();	 

	 $this->redirect($this->createUrl('/listing'));	
	 
	 }	 	
	 
	 public function actionDelete()
	 
	{
		
	  if($_POST['listing_delete_id']!="")
		  
	  {
		  $id = $_POST['listing_delete_id'];
		  
		  $model=$this->loadModel($id);
	 
	 $user_details = User::model()->findAllByAttributes(array("user_default_id"=>$model->user_default_profiles_id));
	 
	 $user_id = $user_details[0]['user_default_id'];
	 
	 $user_name = $user_details[0]['user_default_username'];
	 
	 $folder=$user_name.'_'.$user_id;
	 
	 $path =  $_SERVER['DOCUMENT_ROOT'].'/'; 
	 
	 $temp_folder = $path.'temp/';
			
	 $userfolder = $path.'upload/users/'.$folder.'/';
	 
	 $logo = $model->user_default_listing_thumbnail;
	 
	 $bigimgpath = $userfolder.'listing/big/'.$logo;
	 
	 $thumbimgpath = $userfolder.'listing/thumb/'.$logo;
	 
	 unlink($bigimgpath);
	 
	 unlink($thumbimgpath);
	 
	 $attribs = array('user_default_listing_id'=>$id);
	 
     $criteria = new CDbCriteria(array('order'=>'iuser_default_listing_video_id ASC'));
	 
	 $vids = Userlistingvideos::model()->findAllByAttributes($attribs, $criteria);
	 
	 foreach ($vids as $videos)
	 {
			
			$vid=$videos->user_default_listing_video_link;
			
			$mp4vid = str_replace("flv","mp4",$vid);
			
			$videopath=$userfolder."videos/".$vid; 
			
			$tempvideopath=$temp_folder.$mp4vid; 
			
			unlink($videopath);
	 }
	 
	 $attribs1 = array('user_default_listing_id'=>$id);
	 
     $criteria1 = new CDbCriteria(array('order'=>'user_default_listing_image_id ASC'));
	 
	 $imgs = Userlistingimages::model()->findAllByAttributes($attribs1, $criteria1);
	 
	 foreach ($imgs as $images)
	 {
			
			$img=$images->user_default_listing_image;
			
		    $bigimgpath1 = $userfolder.'listing/big/'.$img;
	 
	        $thumbimgpath1 = $userfolder.'listing/thumb/'.$img;
			
		    unlink($bigimgpath1);
	 
	        unlink($thumbimgpath1);
	 }
	 
     $query = "delete from `user_default_listing_images` where `user_default_listing_id` = :date";
	 
     $command = Yii::app()->db->createCommand($query);
	 
     $command->execute(array('date' => $id));

     $query1 = "delete from `user_default_listing_videos` where `user_default_listing_id` = :date1";

	 $command1 = Yii::app()->db->createCommand($query1);
 
     $command1->execute(array('date1' => $id));
	 
	 $query2 = "delete from `user_default_listing_addresses` where `user_default_listing_id` = :date2";

	 $command2 = Yii::app()->db->createCommand($query2);
 
     $command2->execute(array('date2' => $id));
						
     $model->delete();	 

	 $this->redirect($this->createUrl('/listing'));	
	 
	  }
	  
	}
	 
	 
	/* public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	*/

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{ 	 
	 
        /**
         *  listing you wish to manage             
        **/
		$this->pageTitle='Manage User Listings - Business Supermarket'; 
        $model1= new Userlisting('search');
        $criteria1 = new CDbCriteria;
        $criteria1->compare('user_default_listing_submission_status',1,true);
        //$criteria1->compare('reject_list',0,true);
        $criteria1->compare('user_default_profiles_id',Yii::app()->user->getId(),true); 
        $criteria1->order = 'user_default_listing_id desc';
        $total1 = Userlisting::model()->count($criteria1); 
        
        if(isset($_REQUEST['rows'])){
        	$count1 = $_REQUEST['rows'];
        }else {
        	$count1 = 2;
        }
        
        $pages1 = new CPagination($total1);
        $pages1->setPageSize($count1);
        $pages1->applyLimit($criteria1);  
        $posts1 = Userlisting::model()->findAll($criteria1);
       
        
     
        /**
         * Listing waiting for publication 
        **/     
        $model= new Userlisting('search'); 
        $criteria = new CDbCriteria;
		$criteria->compare('user_default_listing_submission_status',0,true);
        $criteria->compare('user_default_profiles_id',Yii::app()->user->getState('uid'),true); 
        $criteria->order = 'user_default_listing_id desc';
        $total = Userlisting::model()->count($criteria);        
        
        if(isset($_REQUEST['row'])){
        	$count = $_REQUEST['row'];
        }else {
        	$count = 5;
        }
        
        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  
        $posts = Userlisting::model()->findAll($criteria);
        
       $this->render('index',array('model'=>$model,
		'list'=>$posts,
		'pages' => $pages,
		'item_count'=>$total,
		'page_size'=>$count,        
        'model1'=>$model1,
        'list1'=>$posts1,
		'pages1' => $pages1,
		'item_count1'=>$total1, 
		'page_size'=>$count1, 
        )) ;
        
        
        
	}

    public function actionRetail(){
        $model=Contents::model()->find(array('condition'=>"page_seo='retail' AND status=1"));
        if(!$model)
              throw new CHttpException(404,'The requested page does not exist.');
        else{        
        $this->pageTitle=$model->meta_title. ' - Business Supermarket';        
        $this->metaDesc=$model->meta_desc;
        $this->metaKeys=$model->meta_keywords;  

        $criteria1 = new CDbCriteria;
        $criteria1->compare('user_default_listing_category_id',3,true);
        $criteria1->compare('user_default_listing_submission_status',1,true);
        $sort_string = '';
        if(isset($_REQUEST['date_sort']) && $_REQUEST['date_sort']=='oldest'){
            $sort_string = 'user_default_listing_approvedate asc';
        }else {
            $sort_string = 'user_default_listing_approvedate desc';
        }
        // $criteria1->order = 'user_default_listing_id desc';

        if(isset($_REQUEST['name_sort'])){
            if($_REQUEST['name_sort']=='z_a'){
                $sort_string= 'user_default_listing_title desc';
            }else {
                $sort_string= 'user_default_listing_title asc';
            }
        }
        $criteria1->order = $sort_string;

        if(isset($_REQUEST['looking_for'])){
            $criteria1->compare('user_default_listing_lookingfor_id',$_REQUEST['looking_for'],true);
        }


        $total1 = Userlisting::model()->count($criteria1); 
        
        if(isset($_REQUEST['rows'])){
            $count1 = $_REQUEST['rows'];
        }else {
            $count1 = 12;
        }
        
        $pages1 = new CPagination($total1);
        $pages1->setPageSize($count1);
        $pages1->applyLimit($criteria1);  
        $posts1 = Userlisting::model()->findAll($criteria1);
       
        /*if(!Yii::app()->user->isGuest){
            $user_id = Yii::app()->user->id;
            $criteria1->join = 'LEFT OUTER JOIN `drg_favourite_listing` fl ON fl.listing_id=t.user_default_listing_id';
            $criteria1->compare('fl.user_id',$user_id);
            $fav_posts = Userlisting::model()->findAll($criteria1);
        }*/
        $this->render('retail',array('model'=>$model,'posts'=>$posts1,'pages'=>$pages1,'total_posts'=>$total1,'fav_posts'=>$fav_posts));
        }
    }

    public function actionIndustrial(){
        $model=Contents::model()->find(array('condition'=>"page_seo='industrial' AND status=1"));
        if(!$model)
              throw new CHttpException(404,'The requested page does not exist.');
        else{        
        $this->pageTitle=$model->meta_title. ' - Business Supermarket';        
        $this->metaDesc=$model->meta_desc;
        $this->metaKeys=$model->meta_keywords;  

        $criteria1 = new CDbCriteria;
        $criteria1->compare('user_default_listing_category_id',4,true);
        $criteria1->compare('user_default_listing_submission_status',1,true);
        $sort_string = '';
        if(isset($_REQUEST['date_sort']) && $_REQUEST['date_sort']=='oldest'){
            $sort_string = 'user_default_listing_approvedate asc';
        }else {
            $sort_string = 'user_default_listing_approvedate desc';
        }
        // $criteria1->order = 'user_default_listing_id desc';

        if(isset($_REQUEST['name_sort'])){
            if($_REQUEST['name_sort']=='z_a'){
                $sort_string= 'user_default_listing_title desc';
            }else {
                $sort_string= 'user_default_listing_title asc';
            }
        }
        $criteria1->order = $sort_string;

        if(isset($_REQUEST['looking_for'])){
            $criteria1->compare('user_default_listing_lookingfor_id',$_REQUEST['looking_for'],true);
        }


        $total1 = Userlisting::model()->count($criteria1); 
        
        if(isset($_REQUEST['rows'])){
            $count1 = $_REQUEST['rows'];
        }else {
            $count1 = 12;
        }
        
        $pages1 = new CPagination($total1);
        $pages1->setPageSize($count1);
        $pages1->applyLimit($criteria1);  
        $posts1 = Userlisting::model()->findAll($criteria1);
       

        /*if(!Yii::app()->user->isGuest){
            $user_id = Yii::app()->user->id;
            $criteria1->join = 'LEFT OUTER JOIN `drg_favourite_listing` fl ON fl.listing_id=t.user_default_listing_id';
            $criteria1->compare('fl.user_id',$user_id);
            $fav_posts = Userlisting::model()->findAll($criteria1);
        }*/
        $this->render('industrial',array('model'=>$model,'posts'=>$posts1,'pages'=>$pages1,'total_posts'=>$total1,'fav_posts'=>$fav_posts));
        }
    }

    public function actionScience_and_technology(){
        $model=Contents::model()->find(array('condition'=>"page_seo='science-technology' AND status=1"));
        if(!$model)
              throw new CHttpException(404,'The requested page does not exist.');
        else{        
        $this->pageTitle=$model->meta_title. ' - Business Supermarket';        
        $this->metaDesc=$model->meta_desc;
        $this->metaKeys=$model->meta_keywords;  

        $criteria1 = new CDbCriteria;
        $criteria1->compare('user_default_listing_category_id',5,true);
        $criteria1->compare('user_default_listing_submission_status',1,true);
        $sort_string = '';
        if(isset($_REQUEST['date_sort']) && $_REQUEST['date_sort']=='oldest'){
            $sort_string = 'user_default_listing_approvedate asc';
        }else {
            $sort_string = 'user_default_listing_approvedate desc';
        }
        // $criteria1->order = 'user_default_listing_id desc';

        if(isset($_REQUEST['name_sort'])){
            if($_REQUEST['name_sort']=='z_a'){
                $sort_string= 'user_default_listing_title desc';
            }else {
                $sort_string= 'user_default_listing_title asc';
            }
        }
        $criteria1->order = $sort_string;

        if(isset($_REQUEST['looking_for'])){
            $criteria1->compare('user_default_listing_lookingfor_id',$_REQUEST['looking_for'],true);
        }


        $total1 = Userlisting::model()->count($criteria1); 
        
        if(isset($_REQUEST['rows'])){
            $count1 = $_REQUEST['rows'];
        }else {
            $count1 = 12;
        }
        
        $pages1 = new CPagination($total1);
        $pages1->setPageSize($count1);
        $pages1->applyLimit($criteria1);  
        $posts1 = Userlisting::model()->findAll($criteria1);
       

       /* if(!Yii::app()->user->isGuest){
            $user_id = Yii::app()->user->id;
            $criteria1->join = 'LEFT OUTER JOIN `drg_favourite_listing` fl ON fl.listing_id=t.user_default_listing_id';
            $criteria1->compare('fl.user_id',$user_id);
            $fav_posts = Userlisting::model()->findAll($criteria1);
        }*/
        $this->render('science_and_technology',array('model'=>$model,'posts'=>$posts1,'pages'=>$pages1,'total_posts'=>$total1,'fav_posts'=>$fav_posts));
        }
    }

    public function actionBusiness_ideas(){
        $model=Contents::model()->find(array('condition'=>"page_seo='business-support' AND status=1"));
        if(!$model)
              throw new CHttpException(404,'The requested page does not exist.');
        else{        
        $this->pageTitle=$model->meta_title. ' - Business Supermarket';        
        $this->metaDesc=$model->meta_desc;
        $this->metaKeys=$model->meta_keywords;  

        $criteria1 = new CDbCriteria;
        $criteria1->compare('`user_default_listing_category_id`',2,true);
        $criteria1->compare('user_default_listing_submission_status',1,true);
        
		/*
        if(isset($_REQUEST['date_sort']) && $_REQUEST['date_sort']=='oldest'){
            $sort_string = 'user_default_listing_approvedate asc';
        }else {
            $sort_string = 'user_default_listing_approvedate desc';
        }
		*/
        // $criteria1->order = 'user_default_listing_id desc';
$sort_string = '';
        if(isset($_REQUEST['name_sort'])){
            if($_REQUEST['name_sort']=='z_a'){
                $sort_string= 'user_default_listing_title desc';
            }else {
                $sort_string= 'user_default_listing_title asc';
            }
        }
        $criteria1->order = $sort_string;

        if(isset($_REQUEST['looking_for'])){
            $criteria1->compare('user_default_listing_looking_for',$_REQUEST['looking_for'],true);
        }


        $total1 = Userlisting::model()->count($criteria1); 
        
        if(isset($_REQUEST['rows'])){
            $count1 = $_REQUEST['rows'];
        }else {
            $count1 = 12;
        }
        
        $pages1 = new CPagination($total1);
        $pages1->setPageSize($count1);
        $pages1->applyLimit($criteria1);  
        $posts1 = Userlisting::model()->findAll($criteria1);
       

        /* if(!Yii::app()->user->isGuest){
            $user_id = Yii::app()->user->id;
            $criteria1->join = 'LEFT OUTER JOIN `drg_favourite_listing` fl ON fl.listing_id=t.user_default_listing_id';
            $criteria1->compare('fl.user_id',$user_id);
            $fav_posts = Userlisting::model()->findAll($criteria1);
        }*/
        $this->render('business_ideas',array('model'=>$model,'posts'=>$posts1,'pages'=>$pages1,'total_posts'=>$total1,'fav_posts'=>$fav_posts));
        }
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Userlisting('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Userlisting']))
			$model->attributes=$_GET['Userlisting'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Userlisting the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Userlisting::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Userlisting $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='userlisting-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
     
     
    /**
     * select listing action 
     * 
     *     
    */ 
     
    public function actionSelectlisting(){ 
            
        $id = Yii::app()->request->getParam('listid');
         
        $model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'"); 
         
		$this->render('select_listing_action',array('model'=>$model));
    }  
    
    public function actionPurchaseaccess(){ 
            
         
         $id = Yii::app()->request->getParam('listid');
         
         $model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'"); 
         
		$this->render('purchase_access',array('model'=>$model));
    }
	
	public function actionSuspensed()
	{
		 
		if(Yii::app()->user->isGuest)
		{
			$id = Yii::app()->request->getParam('listid');
			$model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");   
			$this->render('login',array('model'=>$model));
		}
		else
		{
			$id = Yii::app()->request->getParam('listid');    
			$model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");   
        	$this->render('preview_user_listing',array('model'=>$model,));	
		}
	
	}
	
	public function actionPublish()
	{
		if(Yii::app()->user->isGuest)
		{
			$id = Yii::app()->request->getParam('listid');
			$model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");	
			$this->render('login',array('model'=>$model));
		}	
		else
		{
			$id = Yii::app()->request->getParam('listid');    
			$model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");   
        	$this->render('preview_user_listing',array('model'=>$model,));	
		}
	}
	
	public function actionRejection()
	{
		if(Yii::app()->user->isGuest)
		{
			$id = Yii::app()->request->getParam('listid');
			$model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");	
			$this->render('login',array('model'=>$model));
		}	
		else
		{
			$id = Yii::app()->request->getParam('listid');    
			$model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");   
        	$this->render('preview_user_listing',array('model'=>$model,));	
		}
	}
	
	public function actionRdelete()
	{
		if(Yii::app()->user->isGuest)
		{
			$id = Yii::app()->request->getParam('listid');
			$model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");
			$this->render('login',array('model'=>$model));	
		}
		else
		{
			$id = Yii::app()->request->getParam('listid');	
			$model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");
			$this->render('preview_user_listing',array('model'=>$model));
		}	
	}
	
	public function actionFupdate()
	{
		if(Yii::app()->user->isGuest)
		{
			$id = Yii::app()->request->getParam('listid');
			$model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");
			$this->render('login',array('model'=>$model));
		}
		else
		{
			$id = Yii::app()->request->getParam('listid');
			$model = Userlisting::model()->find("user_default_profiles_id = '".Yii::app()->user->getState('uid')."' and  user_default_listing_id ='".$id."'");
			$this->render('preview_user_listing',array('model'=>$model));	
		}	
	}
	
     
}
