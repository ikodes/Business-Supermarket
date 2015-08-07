<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $user_default_business_id
 * @property string $user_default_business_name
 * @property string $user_default_business_surname
 * @property string $user_default_business_email
 * @property string $user_default_business_username
 * @property string $user_default_business_pass
 * @property string $user_default_business_image
 * @property string $user_default_business_addr1
 * @property string $user_default_business_addr2
 * @property string $user_default_business_addr3
 * @property string $user_default_business_town
 * @property string $user_default_business_county
 * @property string $user_default_business_zip
 * @property string $user_default_business_country
 * @property string $user_default_business_phone
 * @property string $user_default_business_gender
 * @property string $user_default_business_dob
 * @property string $user_default_business_question
 * @property string $user_default_business_answer
 * @property string $user_default_business_pstatus
 * @property string $user_default_business_notes
 * @property string $user_default_business_rdate
 * @property string $user_default_business_ltime
 * @property string $user_default_business_ip
 * @property string $user_default_business_status
 * @property integer $user_default_business_currency
 * @property string $user_default_business_slogon
 * @property string $user_default_business_title
 * @property string $user_default_business_fax
 * @property string $user_default_business_website
 * @property string $user_default_business_name
 * @property string $user_default_business_user_type
 * @property string $user_default_business_verifycode
 * @property string $user_default_business_active_link
 */
class Business extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Business the static model class
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
		return '{{business}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_business_sector,user_default_business_first_name, user_default_business_surname, user_default_business_email, user_default_business_username, user_default_business_pass, user_default_business_phone, user_default_business_dob, user_default_business_title, user_default_business_name', 'required'),
			array('user_default_business_currency', 'numerical', 'integerOnly'=>true),
			array(' user_default_business_pstatus, user_default_business_ip, user_default_business_slogon, user_default_business_title, user_default_business_fax, user_default_business_website, user_default_business_name, user_default_business_verifycode', 'length', 'max'=>100),
			array('user_default_business_first_name, user_default_business_surname, user_default_business_email, user_default_business_username, user_default_business_pass, user_default_business_dob, user_default_business_rdate, user_default_business_user_type', 'length', 'max'=>50),
			array('user_default_business_image, user_default_business_question', 'length', 'max'=>500),
			array(' user_default_business_answer', 'length', 'max'=>200),
			array('user_default_business_phone', 'length', 'max'=>30),
			array('user_default_business_gender', 'length', 'max'=>10),
			array('user_default_business_status', 'length', 'max'=>2),
			array('user_default_business_active_link', 'length', 'max'=>255),
			array('user_default_business_email, user_default_business_username', 'unique'),
			array('user_default_business_username', 'match', 'pattern'=>'/^[A-Za-z0-9_]+$/u', 'message'=>'Username can contain only alphanumeric characters.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_default_business_id, user_default_business_first_name, user_default_business_surname, user_default_business_email, user_default_business_username, user_default_business_pass, user_default_business_image, user_default_business_phone, user_default_business_gender, user_default_business_dob, user_default_business_question, user_default_business_answer, user_default_business_pstatus, user_default_business_notes, user_default_business_rdate, user_default_business_ltime, user_default_business_ip, user_default_business_status, user_default_business_currency, user_default_business_slogon, user_default_business_title, user_default_business_fax, user_default_business_website, user_default_business_name, user_default_business_sector,user_default_business_user_type, user_default_business_verifycode, user_default_business_active_link', 'safe', 'on'=>'search'),
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
			'user_default_business_id' => 'ID',
			'user_default_business_first_name' => 'First Name',
			'user_default_business_surname' => 'Last Name',
			'user_default_business_email' => 'Email',
			'user_default_business_username' => 'Username',
			'user_default_business_pass' => 'Password',
			'user_default_business_image' => 'Image',
			'user_default_business_phone' => 'Tel No.',
			'user_default_business_gender' => 'Gender',
			'user_default_business_dob' => 'Date of birth',
			'user_default_business_question' => 'Question',
			'user_default_business_answer' => 'Answer',
			'user_default_business_pstatus' => 'Pstatus',
			'user_default_business_notes' => 'Notes',
			'user_default_business_rdate' => 'Registered date',
			'user_default_business_ltime' => 'Ltime',
			'user_default_business_ip' => 'Ip',
			'user_default_business_status' => 'Status',
			'user_default_business_currency' => 'Currency',
			'user_default_business_slogon' => 'Business slogon',
			'user_default_business_title' => 'Title',
			'user_default_business_fax' => 'Fax No.',
			'user_default_business_website' => 'Website',
			'user_default_business_name' => 'Business Name',
            'user_default_business_sector'=>'Business Sector',
			'user_default_business_user_type' => 'User Type',
            'user_default_business_verifycode'=>'Captcha',
            'user_default_business_active_link'=>'Active Link'
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

		$criteria->compare('user_default_business_id',$this->user_default_business_id);
		$criteria->compare('user_default_business_first_name',$this->user_default_business_name,true);
		$criteria->compare('user_default_business_surname',$this->user_default_business_surname,true);
		$criteria->compare('user_default_business_email',$this->user_default_business_email,true);
		$criteria->compare('user_default_business_username',$this->user_default_business_username,true);
		$criteria->compare('user_default_business_pass',$this->user_default_business_pass,true);
		$criteria->compare('user_default_business_image',$this->user_default_business_image,true);
		$criteria->compare('user_default_business_phone',$this->user_default_business_phone,true);
		$criteria->compare('user_default_business_gender',$this->user_default_business_gender,true);
		$criteria->compare('user_default_business_dob',$this->user_default_business_dob,true);
		$criteria->compare('user_default_business_question',$this->user_default_business_question,true);
		$criteria->compare('user_default_business_answer',$this->user_default_business_answer,true);
		$criteria->compare('user_default_business_pstatus',$this->user_default_business_pstatus,true);
		$criteria->compare('user_default_business_notes',$this->user_default_business_notes,true);
		$criteria->compare('user_default_business_rdate',$this->user_default_business_rdate,true);
		$criteria->compare('user_default_business_ltime',$this->user_default_business_ltime,true);
		$criteria->compare('user_default_business_ip',$this->user_default_business_ip,true);
		$criteria->compare('user_default_business_status',$this->user_default_business_status,true);
		$criteria->compare('user_default_business_currency',$this->user_default_business_currency);
		$criteria->compare('user_default_business_slogon',$this->user_default_business_slogon,true);
		$criteria->compare('user_default_business_title',$this->user_default_business_title,true);
		$criteria->compare('user_default_business_fax',$this->user_default_business_fax,true);
		$criteria->compare('user_default_business_website',$this->user_default_business_website,true);
		$criteria->compare('user_default_business_name',$this->user_default_business_name,true);
		$criteria->compare('user_default_business_user_type',$this->user_default_business_user_type,true);
		$criteria->compare('user_default_business_verifycode',$this->user_default_business_verifycode,true);
		$criteria->compare('user_default_business_active_link',$this->user_default_business_active_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}