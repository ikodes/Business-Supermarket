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

 * @property string $co_slogon

 * @property string $co_title

 * @property string $co_fax

 * @property string $co_website

 * @property string $co_name

 * @property string $user_default_business_user_type

 * @property string $user_default_business_verifycode

 * @property string $user_default_business_active_link

 */

class Businessaddress extends CActiveRecord

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

		return '{{business_addresses}}';

	}



	/**

	 * @return array validation rules for model attributes.

	 */

	public function rules()

	{

		// NOTE: you should only define rules for those attributes that

		// will receive user inputs.

		return array(

			array('user_default_business_id , user_default_business_country', 'required'),

			array('user_default_business_id', 'numerical', 'integerOnly'=>true),

			array('user_default_business_country', 'length', 'max'=>100),

			array('user_default_business_zip,user_default_business_town', 'length', 'max'=>50),

			array(' user_default_business_addr1, user_default_business_addr2, user_default_business_addr3', 'length', 'max'=>500),

			array('user_default_business_county', 'length', 'max'=>200),

			// The following rule is used by search().

			// Please remove those attributes that should not be searched.

			array('user_default_business_addr_id, user_default_business_id, user_default_business_addr1, user_default_business_addr2, user_default_business_addr3, user_default_business_town, user_default_business_county, user_default_business_zip, user_default_business_country', 'safe', 'on'=>'search'),

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

			'user_default_business_addr_id' => 'Address ID',
			
			'user_default_business_id' => 'ID',

			'user_default_business_addr1' => 'Address line 1',

			'user_default_business_addr2' => 'Address line 2',

			'user_default_business_addr3' => 'Address line 3',

			'user_default_business_town' => 'Town',

			'user_default_business_county' => 'County',

			'user_default_business_zip' => 'Zip Code',

			'user_default_business_country' => 'Country',

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

		$criteria->compare('user_default_business_addr_id',$this->user_default_business_addr_id,true);

		$criteria->compare('user_default_business_id',$this->user_default_business_id);
		
		$criteria->compare('user_default_business_addr1',$this->user_default_business_addr1,true);

		$criteria->compare('user_default_business_addr2',$this->user_default_business_addr2,true);

		$criteria->compare('user_default_business_addr3',$this->user_default_business_addr3,true);

		$criteria->compare('user_default_business_town',$this->user_default_business_town,true);

		$criteria->compare('user_default_business_county',$this->user_default_business_county,true);

		$criteria->compare('user_default_business_zip',$this->user_default_business_zip,true);

		$criteria->compare('user_default_business_country',$this->user_default_business_country,true);



		return new CActiveDataProvider($this, array(

			'criteria'=>$criteria,

		));

	}

}