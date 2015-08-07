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
                'users'=>array('@'),
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
    
    /* First time register page check validation and save the data */
    
	public function actionIndex()
	{
        $this->pageTitle='User Registration - Business Supermarket';        
        $this->metaDesc='Crate user account for Business Supermarket.';
        $this->metaKeys='user account, business supermarket';        

        $model = new User;
        $activecode =  SharedFunctions::app()->randvalue();         
        
        if(isset($_POST['User']))
        {     
            $model->attributes=$_POST['User']; 
            
            if($model->validate())
            {  
                              
               $post = $_POST['User'];
               //$model->drg_uid =substr(md5(time()),0,9);
               $model->user_default_first_name = $post['user_default_first_name']; 
               $model->user_default_surname = $post['user_default_surname']; 
			   $fdob=$_POST['User']['user_default_dob'];
               list($day1, $month1, $year) = explode("/", $fdob);
			    if(strlen($month1)=="1")
			    {
				   $month =	"0".$month1;			   
			    }
				else
				{
					 $month = $month1;	
				}
				
				if(strlen($day1)=="1")
			    {
				   $day =	"0".$day1;			   
			    }
				else
				{
					 $day = $day1;	
				}
               $dob = "$year-$month-$day";
			   $date_regex = '/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/';
			   if (!preg_match($date_regex, $dob)) 
			   {
			   	//echo CJSON::encode(array('success'=>false,'message'=>"User not registered !"));
               // Yii::app()->end();
			    $this->render('notregister',array('model'=>$model));die;
			   }
			   else
			   {
			   $model->user_default_dob = $dob;			   
			   $model->user_default_username =  $post['user_default_username']; 
               $model->user_default_email = $post['user_default_email']; 
               $model->user_default_password = SharedFunctions::app()->encrypt_code($post['user_default_password']);
               $model->user_default_gender = $post['user_default_gender'];
               $model->user_default_profession = $post['user_default_profession']; 
               $model->user_default_country = $post['user_default_country']; 
               //$model->drg_verifycode = $post['drg_verifycode'];  
               $model->user_default_registration_date = date('Y-m-d');
               //$model->drg_ltime = date('Y-m-d h:i:s');
               $model->user_default_ip = Yii::app()->request->getUserHostAddress();
               $model->user_default_currency = 1;
               $model->user_default_account_status = 0;
               $model->user_default_verifycode = $post['user_default_verifycode'];
               $model->user_default_activate_link = $activecode;
               $model->user_default_type = 'user';
                 
               if($model->save()){
				   
				   $modelnew = new Useraddress;
				   $modelnew->user_default_country = $post['user_default_country']; 
				   $modelnew->user_default_profile_id = $model->user_default_id;
                   $modelnew->save();
				   
                    // Yii::app()->user->setFlash('success', "Your Account Activation link will be sent to");
                                    
                    $template =  MailTemplate::getTemplate('User_Activate_Account');
                    
                    $activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/user/register/activation',array('code'=>$activecode)).'" target="_blank" >Click to active your account</a>';//CHtml::link('',);
       
                    $string = array(
                        '{{#ACCOUNT_ACTIVATION_LINK#}}'=>$activelink,
                        '{{#USERNAME#}}'=>ucwords($model->user_default_first_name .' '.$model->user_default_surname),
                        '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                        '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                        '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
                    );
        
                    $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                    
                    $result =  SharedFunctions::app()->sendmail($model->user_default_email,$template->template_subject,$body);  
                         
                   if($result){
                          
                           /*$logdata = array('member_id'=>Yii::app()->user->getId(),'log_id'=>1,'description'=>Yii::app()->user->name.' has been registered successfully');                                           
                           SharedFunctions::app()->insert_log($logdata); */
                           $this->render('pending',array('model'=>$model));die;
                           //$this->redirect(Yii::app()->createUrl('/user/register/resendactive',array('code'=>$activecode)));
                   }else {
                         echo CJSON::encode(array('success'=>false,'message'=>"User not registered !"));
                         Yii::app()->end();
                   } 
               }      
               
			   }

			   
               unset($_POST['USER']);                             
            }
         
   }      
               $this->render('index',array('model'=>$model)); 

	}     
    
     /* Resend activation link if your not received any activation mail */
    
    public function actionResendactive(){
        
        $codeActive =  Yii::app()->getRequest()->getParam('code');         
         if(isset($codeActive)){
                  
                   $userData =  User::model()->findByAttributes(array('user_default_activate_link'=>$codeActive));
                  $activecode =  SharedFunctions::app()->randvalue(); 
                   $postRecord = User::model()->findByPk($userData['user_default_id']);   
                   $activecode = $codeActive;                
                    if(!empty($userData)){ 
                           
                            
                           $activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/user/register/activation',array('code'=>$activecode)).'" target="_blank" >Click to activate your account</a>';
                    
                           $template =  MailTemplate::getTemplate('User_Activate_Account');
                           
                           $string = array(
                                    '{{#ACCOUNT_ACTIVATION_LINK#}}'=>$activelink,
                                    '{{#USERNAME#}}'=>ucwords($postRecord->user_default_first_name .' '.$postRecord->user_default_surname),
                                    '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                                    '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                                    '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
                            );
                            $postRecord->user_default_activate_link = $activecode;
                            $postRecord->save();
           
                           //die; 
                        $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);      
                          
                        $res = SharedFunctions::app()->sendmail($userData['user_default_email'],$template->template_subject,$body);  
                        
                        $this->render('pending',array('model'=>$userData));
                    
                    }else{                    
                        //Yii::app()->user->setFlash('error', "Opps ! something missing ....");                        
                        $this->redirect('/');                    
                    }
         
           
         }else{
            
               // Yii::app()->user->setFlash('error', "Opps ! something missing ....");
                
                $this->redirect('/');
         } 
    }
    
   /* After get activation mail. click on activation link that time this function called */       
     
    public function actionActivation(){
        
     $codeActive =  Yii::app()->getRequest()->getParam('code');

     if(isset($codeActive)){

       $userData =  User::model()->findByAttributes(array('user_default_activate_link'=>$codeActive));
       
       if(!empty($userData)){
         
               $template =  MailTemplate::getTemplate('User_Registration_Completed');
               //$postRecord = User::model()->findByPk($userData['user_default_id']);
              
              if($userData['user_default_account_status']!='1'){                
                      
                   //$postRecord->user_default_activate_link='';
                   $userData->user_default_account_status='1';
                   $userData->user_default_activate_link='';
                   $userData->save(); 
                   $string = array(
                            '{{#USERNAME#}}'=>ucwords($userData['user_default_first_name'] .' '.$userData['user_default_surname']),
                            '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                            '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                            '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
                   );
                    
                    $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);      
                      
                    SharedFunctions::app()->sendmail($userData['user_default_email'],$template->template_subject,$body); 
                    
                    $user_dirname = strtolower($userData['user_default_username'])."_".$userData['user_default_id'];
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
                    
                    $this->render('active',array('model'=>$userData));
                
                
                }else {
                    
                    $this->render('alreadyactive',array('model'=>$userData));
                    
                }
                
                
            
        }else {
           
            $this->redirect('/');
        
        }        
        
     }   
     
     $this->redirect('/'); 
                
    } 

   /* Resend activation link if your not received any activation mail */   
   public function actionCheckmail(){
    
    $email =  Yii::app()->getRequest()->getParam('eml');
    
    if(SharedFunctions::app()->validateEmail($email)){
        
        $userData =  User::model()->findAllByAttributes(array('user_default_email'=>$email));
		$businessData =  Business::model()->findAllByAttributes(array('user_default_business_email'=>$email));
        if($userData){
            $msg = array('success'=>false,'message'=>"Email address already registered");            
        }else if($businessData){
            $msg = array('success'=>false,'message'=>"Email address already registered");            
        }else {
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
            $userData =  User::model()->findAllByAttributes(array('user_default_username'=>$username));
			$businessData =  Business::model()->findAllByAttributes(array('user_default_business_username'=>$username));
            if($userData){
                $msg = array('success'=>false,'message'=>"Username already taken");            
            }else if($businessData){
                $msg = array('success'=>false,'message'=>"Username already taken");            
            }else {
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
	 
}
