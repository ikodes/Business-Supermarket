<?php
class ListingsController extends Controller
{
	  
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
    
    public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index,update,create,delete,rdelete,publish,rejection,suspension,restore,downloadvideo'),
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
	
	public function actionCreate()
	{
		$model=new Listings;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Listings']))
		{
			$model->attributes=$_POST['Listings'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success', 'User Profile Updated Successfully.');
				$this->redirect(array('view','id'=>$model->user_default_listing_id));
			}
		}

		$this->render('create',array('model'=>$model,));
	}
	
	public function actionUpdate($id)
	{
		
		$model=$this->loadModel($id);
		if(isset($_POST['Listings']))
		{
			$data = $_REQUEST['drg_fprojections1'].",".$_REQUEST['drg_fprojections2'].",".$_REQUEST['drg_fprojections3'].",".$_REQUEST['drg_fprojections4'].",".$_REQUEST['drg_fprojections5'].",".$_REQUEST['drg_fprojections6'];
			$model->user_default_listing_financial_table_status=$_REQUEST['user_default_listing_financial_table_status'];
			$model->user_default_listing_table_currency_code = $_REQUEST['user_default_listing_table_currency_code'];
			$model->user_default_listing_notification_frequency = $_REQUEST['user_default_listing_notification_frequency'];
			$model->user_default_listing_fprojections=$data;	
            $model->attributes=$_POST['Listings'];			

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

				$Userlistingimages->user_default_listing_image_link1 = $_POST['user_default_listing_image_link1'][$i];	

				$Userlistingimages->user_default_listing_image_link2 = $_POST['user_default_listing_image_link2'][$i];   

				$Userlistingimages->user_default_listing_id =  $id;           

				$Userlistingimages->save();      

				}                                      

				}
				
				$user_details = User::model()->findAllByAttributes(array("user_default_id"=>$model->user_default_profiles_id));
				
				$userid=$model->user_default_profiles_id;				

				$username=$user_details[0]['user_default_username'];				

				$upath=$username."_".$userid;

				$path =  $_SERVER['DOCUMENT_ROOT'].'/'; 
				
				$j=0;    

				for($j=0;$j<3;$j++){       

                if($_POST['drg_video'][$j]!=""){ 
				
				$oldvid = $_POST['drg_oldvideo'][$j]; 
				
				$cvidpath1= $path."upload/users/".$upath."/videos/".$oldvid;
				
				unlink($cvidpath1);

                Userlistingvideos::model()->deleteAll("user_default_listing_video_link ='".$oldvid."'"); 				
				
				$Userlistingvideos = new Userlistingvideos;   

				$Userlistingvideos->user_default_listing_video_link = $_POST['drg_video'][$j];  

				$Userlistingvideos->user_default_listing_video_type = "1";  

                $Userlistingvideos->user_default_listing_id =  $id;   				

				$Userlistingvideos->save();  
								
				}
				
				}
				
				
			
			if($model->save())
			{
			
			if($_POST['update'])
			{

		
				$to = $user_details[0]['user_default_email'];
				$subject = "User listing update notification";
				$controller = Yii::app()->controller->action->id; 
			
				$yii_user_request_id1 = Yii::app()->getBaseUrl(true)."/"."listing"."/"."fupdate"."/listid/".$model->user_default_listing_id;
				$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."fupdate"."/listid/".$model->user_default_listing_id.'" target="_blank" >here >> </a>';
			
						
						$template =  MailTemplate::getTemplate('Listing_update');
								$subjectcc=$model['user_default_listing_title']." update notification";
  $sitelink='<a href="'.Yii::app()->getBaseUrl(true).'" target="_blank" >here >> </a>';
    $adminmsg="<p style='background: #C2C3C4;color:#ED7932;border: 1px dashed #000;min-height: 90px;padding: 6px;'>".$_POST['changes']."</p>";
$contactlink = '<a href="'.Yii::app()->getBaseUrl(true).'/contact" target="_blank" >listing support team</a>';

	   $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($model['user_default_listing_title']),
						'{{#USERNAME#}}'=>ucwords($user_details[0]['user_default_first_name'] .' '. $user_details[0]['user_default_surname']),
                        '{{#MESSAGE#}}'=>ucwords($adminmsg),'{{#LSLINK#}}'=>$contactlink,
						'{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id)
                    );
					
					             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                    $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body); 
					
				

				
			}
				Yii::app()->user->setFlash('success', 'User Profile Updated Successfully.');
			  $this->redirect(array('index'));
			}	
		}
		
		
		
		$this->render('update',array(
			'model'=>$model,
		));
	}	
	
	public function loadModel($id)
	{
		$model=Listings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	public function actionIndex()
	{
	   
        $model= new Listings('search'); 
        $criteria = new CDbCriteria;  
      
        if(isset($_REQUEST['username']) && $_REQUEST['username'] !="" ){ 
            
            $Data = User::model()->findAll("LOWER(user_default_username) like '%".addslashes(strtolower($_REQUEST['username']))."%'"); 
             
            if($Data){
            
                foreach($Data as $rsData){
            
                   $ids[]= $rsData->user_default_id;                      
            
                } 
                //$ids1 = array(rtrim($ids,','));
                $criteria->addInCondition('user_default_profiles_id',$ids);
            }    
        } 
         if(isset($_REQUEST['user_default_listing_category_id']) && $_REQUEST['user_default_listing_category_id'] !="" ){          
                  
              $criteria->compare('user_default_listing_category_id',addslashes($_REQUEST['user_default_listing_category_id']),true);           
        }         
        
         if(isset($_REQUEST['user_default_listing_lookingfor_id']) && $_REQUEST['user_default_listing_lookingfor_id'] !="" ){ 
            
            $criteria->compare('user_default_listing_lookingfor_id',addslashes($_REQUEST['user_default_listing_lookingfor_id']),true); 
        } 
        
        
         if(isset($_REQUEST['user_default_listing_limit_viewing_id']) && $_REQUEST['user_default_listing_limit_viewing_id'] !="" ){ 
            
            $criteria->compare('user_default_listing_limit_viewing_id',addslashes($_REQUEST['user_default_listing_limit_viewing_id']),true); 
        } 
        
        
         if(isset($_REQUEST['user_default_listing_title']) && $_REQUEST['user_default_listing_title'] !="" ){ 
            $criteria->compare('user_default_listing_title',addslashes($_REQUEST['user_default_listing_title']),true); 
          
        } 
        
        
         if(isset($_REQUEST['Keyword']) && $_REQUEST['Keyword'] !="" ){ 
             $criteria->compare('user_default_listing_keywords',addslashes($_REQUEST['Keyword']),true); 
        
        } 
        
        $criteria->order = 'user_default_listing_id desc';
        // print_r($criteria);
         
        
        
        $total = Listings::model()->count($criteria); 
    
        if(isset($_REQUEST['rows'])){
        	$count = $_REQUEST['rows'];
        }else {
        	$count = 5;
        } 
        
        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  // the trick is here!
	 
       $posts = Listings::model()->findAll($criteria);

       $this->render('index',array('model'=>$model,
		'list'=>$posts,
		'pages' => $pages,
		'item_count'=>$total,
		'page_size'=>Yii::app()->params['listPerPage']       
        )) ;
		
	}
	public function actionDelete($id)
	{ 
	
	Userlistingimages::model()->deleteAll("user_default_listing_id  ='".$id."'");  
	
	Userlistingvideos::model()->deleteAll("user_default_listing_id ='".$id."'");	
	
	$this->loadModel($id)->delete();  
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
	public function actionRdelete($id)
	{
		$model = $this->loadModel($id);
		
		
		if(isset($model))
		{
			$model->user_default_listing_submission_status = 0;
			//$model->drg_deletedate = date('Y-m-d H:i:s');
			if($model->save()){ 
			
			if($_POST['delete'])
			{
			
			$user_details = User::model()->findAllByAttributes(array("user_default_id"=>$model->user_default_profiles_id));
			
			$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."rdelete"."/listid/".$model->user_default_listing_id.'" target="_blank" >here >> </a>';

			$to = $user_details[0]['user_default_email'];
			$subject = "User listing deletion notification";
			
							$template =  MailTemplate::getTemplate('Listing_mark_delete');
								$subjectcc="Listing ".$model['user_default_listing_title']." has been marked for deletion ";
   $adminmsg="<p style='background: #C2C3C4;color:#ED7932;border: 1px dashed #000;min-height: 90px;padding: 6px;'>".$_POST['deletionval']."</p>";
  $sitelink='<a href="'.Yii::app()->getBaseUrl(true)."/page/faq".'" target="_blank" >here >> </a>';
 $contactlink = '<a href="'.Yii::app()->getBaseUrl(true).'/contact" target="_blank" >customer listing support team</a>';
	   $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($model['user_default_listing_title']),
						'{{#USERNAME#}}'=>ucwords($user_details[0]['user_default_first_name'] .' '. $user_details[0]['user_default_surname']),
						'{{#MESSAGE#}}'=>ucwords($adminmsg),'{{#CSLINK#}}'=>$contactlink,
						'{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id),
						'{{#SITELINK#}}'=>ucwords($sitelink),
                                            );
					
					             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                    $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body); 
					
			      	    
			}$this->redirect(array('index'));
                //$this->render('update',array('model'=>$model,));
            }else {
               $this->render('update',array('model'=>$model,));
            } 	
				
		}
		
			
		
	}
	
	public function actionPublish($id)
	{
		 	$model=$this->loadModel($id);
			$user_details = User::model()->findAllByAttributes(array("user_default_id"=>$model->user_default_profiles_id));
			$to = $user_details[0]['user_default_email'];
			
			$controller = Yii::app()->controller->action->id; 
			$status="Published";
			$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."view?id=".$model->user_default_listing_id.'" target="_blank" >here >> </a>';
			
				$template =  MailTemplate::getTemplate('user_listing_publish');
								
  $sitelink='<a href="'.Yii::app()->getBaseUrl(true).'" target="_blank" >here >> </a>';
     $llink='<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."selectlisting"."/"."listid"."/".$model->user_default_listing_id.'" target="_blank" >here >> </a>';
	   	$ltitle="<i>".$model['user_default_listing_title']."</i>";
	   		        $ldate="<i>".$model['user_default_listing_date']."</i>";
			        $lstatus="<i>".$status."</i>";

	   $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($ltitle),
						'{{#USERNAME#}}'=>ucwords($user_details[0]['user_default_first_name'] .' '. $user_details[0]['user_default_surname']),
                        '{{#LISTINGDATE#}}'=>ucwords($ldate),
						'{{#LISTINGSTATUS#}}'=>ucwords($lstatus),
						'{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id),
						'{{#SITELINK#}}'=>ucwords($sitelink),
						'{{#LLINK#}}'=>ucwords($llink)                       
                    );
					
					             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                    $result =  SharedFunctions::app()->sendmail($to,$template->template_subject,$body);  
		
		
		if(isset($model))
		{
			$model->user_default_listing_submission_status = 1;
			$model->user_default_listing_approvedate = date('Y-m-d');
			/*
			 $attribs = array('user_default_listing_id'=>$model->user_default_listing_id);
            $criteria = new CDbCriteria(array('order'=>'iuser_default_listing_video_id ASC'));
			$vids = Userlistingvideos::model()->findAllByAttributes($attribs, $criteria);
			foreach ($vids as $videos)
			{
			
			$cvid1=$videos->drg_listing_video;
            $tvid1=str_replace('flv','mp4',$cvid1);
			$path =  $_SERVER['DOCUMENT_ROOT'].'/'; 
			$temp_dir=$path."temp/";
			$tvidpath1=$path."temp/".$tvid1; 
			unlink($tvidpath1);
			}
			*/

			if($model->save()){           	    
                $this->render('update',array('model'=>$model,));
            }else {
               $this->render('update',array('model'=>$model,));
            } 	
		}
		$this->redirect(array('index'));
		
			
	}
	
	public function actionRejection($id)
	{
		$model = $this->loadModel($id);	
		
		
		if($_POST['rejection'])
		{
			$user_details = User::model()->findAllByAttributes(array("user_default_id"=>$model->user_default_profiles_id));
			$to = $user_details[0]['user_default_email'];
			$subject = "User listing rejection notification";
			$controller = Yii::app()->controller->action->id; 
			$yii_user_request_id = Yii::app()->getBaseUrl(true)."/"."listing"."/"."rejection"."/listid/".$model->user_default_listing_id;
			
						$template =  MailTemplate::getTemplate('Listing_rejection');
								$subjectcc=$model['user_default_listing_title']." rejection notification";
  $sitelink='<a href="'.Yii::app()->getBaseUrl(true).'" target="_blank" >here >> </a>';
    $rmessage="<p style='background: #C2C3C4;color:#ED7932;border: 1px dashed #000;min-height: 90px;padding: 6px;'>".$_POST['rejectval']."</p>";

	   $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($model['user_default_listing_title']),
						'{{#USERNAME#}}'=>ucwords($user_details[0]['user_default_first_name'] .' '. $user_details[0]['user_default_surname']),
                        '{{#MESSAGE#}}'=>ucwords($rmessage),
						'{{#SITELINK#}}'=>ucwords($sitelink)
                    );
					
					             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                    $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);  
			
							
		}
		if(isset($model))
		{
			$model->reject_list =1;
			
			if($model->save()){           	    
                $this->render('update',array('model'=>$model,));
            }else {
               $this->render('update',array('model'=>$model,));
            } 	
		}
	}
	
	public function actionSuspension($id)
	{
		
		 $model=$this->loadModel($id);
		 
		if($_POST['suspension'])
		{			
				
			$user_details = User::model()->findAllByAttributes(array("user_default_id"=>$model->user_default_profiles_id));
			$to = $user_details[0]['user_default_email'];
	
			$controller = Yii::app()->controller->action->id; 
		 	$yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."suspensed"."/listid/".$model->user_default_listing_id.'" target="_blank" >here >> </a>';
			
$template =  MailTemplate::getTemplate('Listing_suspension');

 $adminmsg=$_POST['suspensionval'];

$string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($data['user_default_listing_title']),
                        '{{#USERNAME#}}'=>ucwords($user_details[0]['user_default_first_name'].' '.$user_details[0]['user_default_surname']),
                        '{{#MESSAGE#}}'=>ucwords($adminmsg),
						'{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id)					
                        );
$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
$result =  SharedFunctions::app()->sendmail($to,$template->template_subject,$body);
						
		}
		
		if(isset($model))
		{
			$model->user_default_listing_submission_status =0;
			$model->user_default_listing_approvedate = date('Y-m-d');
			if($model->save()){           	    
                $this->render('update',array('model'=>$model,));
            }else {
               $this->render('update',array('model'=>$model,));
            } 	
		}
		
	}
	
	public function actionRestore($id)
	{
		$model = $this->loadModel($id);
		if(isset($model))
		{
			$model->user_default_listing_submission_status = 4;
			if($model->save()){ 						  			$user_details = User::model()->findAllByAttributes(array("user_default_id"=>$model->user_default_profiles_id));			$to = $user_details[0]['user_default_email'];			$controller = Yii::app()->controller->action->id; 		    $site=Yii::app()->getBaseUrl(true);						$sitelink='<a href="'.Yii::app()->getBaseUrl(true).'" target="_blank" >'.$site.'</a>';			            $template =  MailTemplate::getTemplate('Listing_restore');            $subjectcc=" Listing ".$model->user_default_listing_title." has been restored";            $string = array(                        '{{#LISTINGTITLE#}}'=>ucwords($model->user_default_listing_title),                        '{{#USERNAME#}}'=>ucwords($user_details[0]['user_default_first_name'].' '.$user_details[0]['user_default_surname']),                        '{{#SITELINK#}}'=>ucwords($sitelink)					                        );            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);            $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);			
              //$this->render('update',array('model'=>$model,));			  
            }else {
               $this->render('update',array('model'=>$model,));
            } 				 $this->redirect(array('index'));
		}	
	}
	
public function userToString()
{
    $targets = $this->drg_user;
	
		
    if ($targets) 
        {
        $string = '';
        foreach($targets as $target) {
            $string .= $targets->user_default_first_name . ', ';
        }
        return substr($string,0,strlen($string)-1);
    }
    return null;
}

public function actionDownloadvideo(){
    
    $filename = Yii::app()->request->getParam('file'); 
    
     
    $fileData = Userlistingvideos::model()->find("user_default_listing_video_link = '".$filename."'");   
   
   
    $ListingData =  Listings::model()->find("user_default_listing_id= '".$fileData->user_default_listing_id."'");     
   
    $userData = User::model()->find("user_default_id = '" .$ListingData->user_default_profiles_id."'"); 
    
    
    
  /*  echo Yii::getPathOfAlias('webroot.upload.users.'.$userData->drg_username.'_'.$userData->drg_id).'/videos/'.$filename;
    die; */
   
    @EDownloadHelper::download(Yii::getPathOfAlias('webroot.upload.users.'.$userData->user_default_username.'_'.$userData->user_default_id).'/videos/'.$filename);
    return;
}	
	
}