<?php

class RegisterController extends Controller
{
   public function init(){
		// register class paths for extension captcha extended
		Yii::$classMap = array_merge( Yii::$classMap, array(
			'CaptchaExtendedAction' => Yii::getPathOfAlias('ext.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedAction.php',
			'CaptchaExtendedValidator' => Yii::getPathOfAlias('ext.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedValidator.php'
		));
	} 
   
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to perform any action
                'actions'=>array(''),
                'users'=>array('*'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }    

    public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CaptchaExtendedAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
   
      
   public function actionIndex(){
   /*   $connection = Yii::app()->db;	    $mainslider =  Sliderlisting::model()->find("page_name = ".$sliderfunc);    $sliderfile = $mainslider->page_slug;	$getslider = $connection->createCommand("DELETE FROM `user_default_business` WHERE 1 ");  $sliderresult = $getslider->queryRow(); */  
    $model= new Business;		$modelnew = new Businessaddress;		$this->pageTitle='Business Registration - Business Supermarket';  
    
    if(isset($_POST['Business']))
    {		
        $model->attributes=$_POST['Business'];
        
		$activecode =  SharedFunctions::app()->randvalue(); 
        
        if($model->validate())
        {
            $post = $_POST['Business'];						$post1 = $_POST['Businessaddress'];
            $model->user_default_business_name = $post['user_default_business_name'];
            $model->user_default_business_slogon = $post['user_default_business_slogon'];
            $model->user_default_business_first_name = $post['user_default_business_first_name']; 
            $model->user_default_business_surname = $post['user_default_business_surname']; 
            $model->user_default_business_title = $post['user_default_business_title'];
            list($day, $month, $year) = explode("/", $post['user_default_business_dob']);
            $dob = "$year-$month-$day";
            $model->user_default_business_dob = $dob;
            $model->user_default_business_username =  $post['user_default_business_username']; 
            $model->user_default_business_email = $post['user_default_business_email']; 
            $model->user_default_business_pass = SharedFunctions::app()->encrypt_code($post['user_default_business_pass']); 
            $model->user_default_business_phone = $post['user_default_business_phone'];
            $model->user_default_business_fax = $post['user_default_business_fax'];
            $model->user_default_business_website = $post['user_default_business_website'];                
            $model->user_default_business_verifycode = $post['user_default_business_verifycode'];  
            $model->user_default_business_pstatus = 0;
            $model->user_default_business_ip = Yii::app()->request->getUserHostAddress();
            $model->user_default_business_status = 'y';
            $model->user_default_business_currency = 1; 
            $model->user_default_business_active_link = $activecode;
            $model->user_default_business_user_type = 'business';   
            $model->user_default_business_rdate = date('Y-m-d');
            $model->user_default_business_ltime = date('Y-m-d h:i:s');
            // $uploadedFile = CUploadedFile::getInstance($model, 'user_default_business_image');
            // $validfile = Yii::app()->params['valid_image']; 
            // if ($uploadedFile != null && $validfile) {

            //   $fileName = SharedFunctions::app()->encrypt_code(rand(0,999999).time())."{$uploadedFile}";  // random number + Timestamp + file name

            //   $model->user_default_business_image = $fileName;
            //   if (!empty($uploadedFile)) {
            //       $uploadedFile -> saveAs('./upload/logo/'. $fileName); // save images in given destination folder
            //   }

            // }  

               if($model->save())
			   {			   		

					$businessid = $model->user_default_business_id;
					
				    $modelnew->user_default_business_id = $businessid; 	
					
					$modelnew->user_default_business_addr1 = $post1['user_default_business_addr1'];	

					$modelnew->user_default_business_addr2 = $post1['user_default_business_addr2'];		

					$modelnew->user_default_business_addr3 = $post1['user_default_business_addr3'];		

					$modelnew->user_default_business_town = $post1['user_default_business_town'];		

					$modelnew->user_default_business_county = $post1['user_default_business_county'];	

					$modelnew->user_default_business_zip = $post1['user_default_business_zip'];				

					$modelnew->user_default_business_country = $post1['user_default_business_country']; 
					
					
                    if($modelnew->validate()){					 

					$modelnew->save();             

					}									
                    $template = MailTemplate::getTemplate('Business_Activate_Account');
                    
                    $activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/business/register/activation',array('code'=>$activecode)).'" target="_blank" >Click to active your account</a>'; 
       
                    $string = array(
                        '{{#ACCOUNT_ACTIVATION_LINK#}}'=>$activelink,
                        '{{#USERNAME#}}'=>ucwords($model->user_default_business_first_name .' '.$model->user_default_business_surname),
                        '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                        '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                        '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
                    );
        
                   $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                   SharedFunctions::app()->sendmail($model->user_default_business_email,$template->template_subject,$body); 
                   $this->render('pending',array('model'=>$model));
			   }
			   
		   
		    // form inputs are valid, do something here
            return;
        }
    }
    
    $this->render('index',array('model'=>$model));   
     
   }
   
   
   
   public function actionActivation(){ 
    
    
     $codeActive =  Yii::app()->getRequest()->getParam('code');
    
     if(isset($codeActive)){
              
       $userData =  Business::model()->findByAttributes(array('user_default_business_active_link'=>$codeActive));
       
       if(!empty($userData)){
         
               $template =  MailTemplate::getTemplate('Business_Registration_Completed');
               $postRecord = Business::model()->findByPk($userData['user_default_business_id']);
               $postRecord->user_default_business_active_link='';
               $postRecord->user_default_business_pstatus=1;
               $postRecord->save(); 
               $string = array(
                        '{{#USERNAME#}}'=>ucwords($userData['user_default_business_first_name'] .' '.$userData['user_default_business_surname']),
                        '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                        '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                        '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
               );
                
                $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);      
                  
                SharedFunctions::app()->sendmail($userData['user_default_business_email'],$template->template_subject,$body); 
                
                $user_dirname = strtolower($userData['user_default_business_username'])."_".$userData['user_default_business_id'];
                
                $user_dir = Yii::app()->basePath.'/../www/upload/users/'.$user_dirname;
                
                if(!is_dir($user_dir))
                {
                    $oldmask = umask(0);
						mkdir($user_dir, 0777);
						umask($oldmask);
                }
                
                $user_imagedir= Yii::app()->basePath.'/../www/upload/users/'.$user_dirname.'/images';
                if(!is_dir($user_imagedir))
                {
                    $oldmask = umask(0);
						mkdir($user_imagedir, 0777);
						umask($oldmask);
                }
                
                $user_videodir=$user_imagedir= Yii::app()->basePath.'/../www/upload/users/'.$user_dirname.'/videos';
                if(!is_dir($user_videodir))
                {
                    $oldmask = umask(0);
						mkdir($user_videodir, 0777);
						umask($oldmask);
                } 
                
                $logdata = array('member_id'=>$userData['user_default_business_id'],'log_id'=>1,'description'=>ucwords($userData['user_default_business_first_name'] .' '.$userData['user_default_business_surname']).' has been registered successfully');                               
                
               // SharedFunctions::app()->insert_log($logdata);   
                   
                
                $this->render('active',array('model'=>$userData));
            
        }else {
           
            $this->redirect('/');
        
        }        
        
     }else {
        $this->redirect('/');
     } 
   }
   
   /* Resend activation link if your not received any activation mail */
    
    public function actionResendactive(){
        
        $codeActive =  Yii::app()->getRequest()->getParam('code'); 
        
         if(isset($codeActive)){
                  
                   $userData =  Business::model()->findByAttributes(array('user_default_business_active_link'=>$codeActive));
                   $activecode =  $codeActive;//SharedFunctions::app()->randvalue(); 
                   $postRecord = Business::model()->findByPk($userData['user_default_business_id']);                   
                    if(!empty($userData)){  
                            
                           $activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/business/register/activation',array('code'=>$activecode)).'" target="_blank" >Click to activate your account</a>';
                    
                           $template =  MailTemplate::getTemplate('Business_Activate_Account');
                           
                           $string = array(
                                    '{{#ACCOUNT_ACTIVATION_LINK#}}'=>$activelink,
                                    '{{#USERNAME#}}'=>ucwords($postRecord->user_default_business_first_name .' '.$postRecord->user_default_business_surname),
                                    '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                                    '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                                    '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
                            );
                            $postRecord->user_default_business_active_link = $activecode;
                            
                            $postRecord->save();
           
                           
                        $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);      
                          
                        $res = SharedFunctions::app()->sendmail($userData['user_default_business_email'],$template->template_subject,$body);  
                        
                        $this->render('pending',array('model'=>$postRecord));
                    
                    }else{
                    
                        //Yii::app()->user->setFlash('error', "Opps ! something missing ....");
                        
                        $this->redirect('/');
                    
                    } 
         
           
         }else{
            
                //Yii::app()->user->setFlash('error', "Opps ! something missing ....");
                
                $this->redirect('/');
         } 
    }
   
   public function actionCheckmail(){
    
    $email =  Yii::app()->getRequest()->getParam('eml');
    
    if(SharedFunctions::app()->validateEmail($email)){
        
        $userData =  User::model()->findByAttributes(array('user_default_email'=>$email));
		$businessData =  Business::model()->findByAttributes(array('user_default_business_email'=>$email));
        if($userData){
            $msg = array('success'=>false,'message'=>"Email address already registered");            
        }
		else if($businessData){
            $msg = array('success'=>false,'message'=>"Email address already registered");            
        }		
		else {
             $msg = array('success'=>true,'message'=>"Email address not registered");   
        }
        
    }else {
        
         $msg = array('success'=>false,'message'=>"Please enter valid email !");
          
    }
    if(!empty($msg)){
        echo CJSON::encode($msg);
        Yii::app()->end();
    }
    
   }
   
   public function actionCheckuser(){
        $username =  Yii::app()->getRequest()->getParam('uname');
        if($username){            
            $userData =  User::model()->findByAttributes(array('user_default_username'=>$username));
			$businessData =  Business::model()->findByAttributes(array('user_default_business_username'=>$username));
            if($userData){
                $msg = array('success'=>false,'message'=>"Username already taken");            
            }else if($businessData){
                $msg = array('success'=>false,'message'=>"Username already taken");            
            }			
			else {
                 $msg = array('success'=>true,'message'=>"Username not taken");   
            }
            
        }else {
            
             $msg = array('success'=>false,'message'=>"Please enter valid username !");
              
        }
        if(!empty($msg)){
            echo CJSON::encode($msg);
            Yii::app()->end();
        }
   }
   
   public function actionUploadprofileimage(){       
       Yii::import("ext.EAjaxUpload.qqFileUploader");        
       $folder = Yii::app()->basePath.'/../www/upload/logo/';// folder for uploaded files                
       if (!file_exists($folder)) {
            $oldmask = umask(0);
						mkdir($folder, 0777);
						umask($oldmask);
       }
       
       $allowedExtensions = array("jpg",'png','gif');//array("jpg","jpeg","gif","exe","mov" and etc...       
       $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes       
       $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);       
              
       $result = $uploader->handleUpload($folder);          
       echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);                      
       exit;
   }
}
