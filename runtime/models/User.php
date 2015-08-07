<?php
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{profiles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
		public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
			array('user_default_first_name', 'required','message'=>'Enter Your Name'),

            array('user_default_surname', 'required','message'=>'Enter Your Surname'),

            array('user_default_email', 'required','message'=>'Enter Valid Email Address'),

            array('user_default_username', 'required','message'=>'Enter Your Username'),
			
			//array('username', 'unique', 'attributeName'=> 'username', 'caseSensitive' => 'true'),

            array('user_default_password', 'required','message'=>'Enter Your Password'), 

            //array("drg_verifycode","required","message"=>'Please Enter The Security Code'),

            array("user_default_gender","required","message"=>''),

            array("user_default_dob","required","message"=>''),

			array('user_default_first_name,user_default_surname,user_default_email,user_default_username,user_default_gender,user_default_dob', 'required'),
			array('user_default_first_name,user_default_surname, user_default_username, user_default_password, user_default_type', 'length', 'max'=>50),
			array('user_default_verifycode', 'length', 'max'=>150),
			array('user_default_ip , user_default_verifycode , user_default_profile_image , user_default_email', 'length', 'max'=>100),
			array('user_default_tel', 'length', 'max'=>30),
			array('user_default_currency', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_default_id, user_default_ip, user_default_first_name, user_default_surname, user_default_username, user_default_email, user_default_currency, user_default_profession, user_default_country, user_default_gender, user_default_dob, user_default_type, user_default_tel, user_default_profile_image, user_default_registration_date, user_default_admin_notes, user_default_verifycode, user_default_activate_link, user_default_account_status', 'safe', 'on'=>'search'),
		);
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
		public function attributeLabels()
	{
		return array(
'user_default_id' => 'User ID', 'user_default_ip' => 'User IP', 'user_default_first_name' => 'First name', 'user_default_surname' => 'Last name', 'user_default_username' => 'Username', 'user_default_email' => 'Email', 'user_default_password' => 'Password', 'user_default_currency' => 'Currency', 'user_default_profession' => 'Title', 'user_default_country' =>'Country','user_default_gender' => 'Gender', 'user_default_dob' => 'Date of birth', 'user_default_type' => 'Type', 'user_default_tel' => 'Telephone', 'user_default_profile_image' => 'Profile Image', 'user_default_registration_date' => 'Registration Date', 'user_default_admin_notes' => 'Admin Notes', 'user_default_verifycode' => 'Verify Code', 'user_default_activate_link' => 'Activation Link', 'user_default_account_status' => 'Account Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

				$criteria->compare('user_default_id',$this->user_default_id); 
		$criteria->compare('user_default_ip',$this->user_default_ip,true);
		$criteria->compare('user_default_first_name',$this->user_default_first_name,true);
		$criteria->compare('user_default_surname',$this->user_default_surname,true);
		$criteria->compare('user_default_username',$this->user_default_username,true);
		$criteria->compare('user_default_email',$this->user_default_email,true);
		$criteria->compare('user_default_password',$this->user_default_password,true);
		$criteria->compare('user_default_currency',$this->user_default_currency,true);
		$criteria->compare('user_default_profession',$this->user_default_profession,true);
		$criteria->compare('user_default_country',$this->user_default_country,true);
		$criteria->compare('user_default_gender',$this->user_default_gender,true);
		$criteria->compare('user_default_dob',$this->user_default_dob,true);
		$criteria->compare('user_default_type',$this->user_default_type,true);
		$criteria->compare('user_default_tel',$this->user_default_tel,true);
		$criteria->compare('user_default_profile_image',$this->user_default_profile_image,true);
		$criteria->compare('user_default_registration_date',$this->user_default_registration_date,true);
		$criteria->compare('user_default_admin_notes',$this->user_default_admin_notes,true);
		$criteria->compare('user_default_verifycode',$this->drg_phone,true);
		$criteria->compare('user_default_activate_link',$this->user_default_activate_link,true);
		$criteria->compare('user_default_account_status',$this->user_default_account_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getUserImgDir()
	{
		if(!Yii::app()->user->isGuest)
		{
			$user_dirname = strtolower(Yii::app()->user->username).'_'. Yii::app()->user->getId();
			return Yii::app()->basePath.'/../www/upload/users/'.$user_dirname.'/images/';
		}else
			return Yii::app()->basePath.'/../www/upload/logo/';
	}
}