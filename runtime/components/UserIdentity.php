<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
     
    public $userId; 
    
    private $_id;
    
    public $_idcode;
    
    private $_usertype;
    
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
         
        if($this->username==""){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
            
        }else if($this->password ==""){
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }else {
             
             
             
			  /* OLD CODE START
			  $userData = User::model()->findByAttributes(array('user_default_username'=>$this->username,'user_default_account_status'=>'1','user_default_password' =>SharedFunctions::app()->encrypt_code($this->password)));
			 $businessData = Business::model()->findByAttributes(array('user_default_business_username'=>$this->username,'user_default_business_status'=>'y','user_default_business_pass' =>SharedFunctions::app()->encrypt_code($this->password)));
			 if(!empty($userData)){
                if($userData->user_default_account_status=='0'){
                   $this->errorCode='Your account is not active !';
                }else{
                    Yii::app()->user->setState('name', $userData->user_default_first_name.' '.$userData->user_default_surname);
                    Yii::app()->user->setState('username', $userData->user_default_username);
                    Yii::app()->user->setState('uid',$userData->user_default_id);
                    Yii::app()->user->setState('ufolder',$userData->user_default_username.'_'.$userData->user_default_id);
                    Yii::app()->user->setState('_user_Type',$userData->user_default_type);
                    $this->_id = $userData->user_default_id;
                    $this->_idcode = $userData->user_default_id; 
                    $this->errorCode=self::ERROR_NONE;
                }
             }
			 
			 else if(!empty($businessData)){
				   if($businessData->user_default_business_status=='n'){
                   $this->errorCode='Your account is not active !';
                }else{
                    Yii::app()->user->setState('name', $businessData->user_default_business_first_name.' '.$businessData->user_default_business_surname);
                    Yii::app()->user->setState('username', $businessData->user_default_business_username);
                    Yii::app()->user->setState('uid',$businessData->user_default_business_id);
                    Yii::app()->user->setState('ufolder',$businessData->user_default_business_username.'_'.$businessData->user_default_business_id);
                    Yii::app()->user->setState('_user_Type',$businessData->user_default_business_user_type);
                    $this->_id = $businessData->user_default_business_id;
                    $this->_idcode = $businessData->user_default_business_id; 
                    $this->errorCode=self::ERROR_NONE;
                }
				 
			 }
			 else {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
             }   
			 OLD CODE END */
			 
             $connection = Yii::app()->db;
			 $user = $this->username;
			 $pass = SharedFunctions::app()->encrypt_code($this->password);
			 $usersql = $connection->createCommand("select * from `user_default_profiles` where BINARY `user_default_username`='$user' and user_default_password = '$pass' ");
			 $userData = $usersql->queryRow();
			 
			 $businesssql = $connection->createCommand("select * from `user_default_business` where BINARY `user_default_business_username`='$user' and user_default_business_pass = '$pass' ");
			 $businessData = $businesssql->queryRow();
			 
			 if($userData['user_default_id']!="")
		   {
			   Yii::app()->user->setState('name', $userData[user_default_first_name].$userData[user_default_surname]);
                    Yii::app()->user->setState('username', $userData[user_default_username]);
                    Yii::app()->user->setState('uid',$userData[user_default_id]);
                    Yii::app()->user->setState('ufolder',$userData[user_default_username].$userData[user_default_id]);
                    Yii::app()->user->setState('_user_Type',$userData[user_default_type]);
                    $this->_id = $userData[user_default_id];
                    $this->_idcode = $userData[user_default_id]; 
                    $this->errorCode=self::ERROR_NONE;
		   }
             else if($businessData['user_default_business_id']!="")
		   {
			   Yii::app()->user->setState('name', $businessData[user_default_business_first_name].$businessData[user_default_business_surname]);
                    Yii::app()->user->setState('username', $businessData[user_default_business_username]);
                    Yii::app()->user->setState('uid',$businessData[user_default_business_id]);
                    Yii::app()->user->setState('ufolder',$businessData[user_default_business_username].$businessData[user_default_business_id]);
                    Yii::app()->user->setState('_user_Type',$businessData[user_default_business_user_type]);
                    $this->_id = $businessData[user_default_business_id];
                    $this->_idcode = $businessData[user_default_business_id]; 
                    $this->errorCode=self::ERROR_NONE;
		   }
			 else {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
             }   
        }        
        return !$this->errorCode;
        
        
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function getIdcode()
    {
        return $this->_idcode;
    }
     
}