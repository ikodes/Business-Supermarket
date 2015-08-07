<?php

/**
 * This is the model class for table "{{listing_addresses}}".
 *
 * The followings are the available columns in table '{{listing_addresses}}':
 * @property integer $drg_uaid
 * @property string $drg_uid
 * @property string $drg_addr1
 * @property string $drg_addr2
 * @property string $drg_addr3
 * @property string $drg_town
 * @property string $drg_county
 * @property string $drg_zip
 * @property string $drg_country
 * @property string $drg_phone
 * @property string $drg_createdate
 * @property string $drg_ipaddress
 */
class Listingaddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Useraddress the static model class
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
		return '{{listing_addresses}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('', 'required'),
			array('user_default_listing_address_id, user_default_listing_company_name, user_default_listing_address1,user_default_listing_address2,user_default_listing_address3, user_default_listing_town', 'length', 'max'=>100),
			array('user_default_listing_country, user_default_listing_zip_code, user_default_listing_tel,user_default_listing_county', 'length', 'max'=>100),
			//array('drg_county', 'length', 'max'=>200),
			//array('drg_zip', 'length', 'max'=>50),
			//array('drg_phone', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_default_listing_address_id, user_default_listing_company_name, user_default_listing_address1,user_default_listing_address2,user_default_listing_address3, user_default_listing_town, user_default_listing_county, user_default_listing_country, user_default_listing_zip_code, user_default_listing_tel, user_default_listing_id', 'safe', 'on'=>'search'),
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
			'user_default_listing_address_id' => 'Address id',
			'user_default_listing_company_name' => 'Company Name',
			'user_default_listing_address1' => 'Address 1',
			'user_default_listing_address2' => 'Address 2',
			'user_default_listing_address3' => 'Address 3',
			'user_default_listing_town' => 'Town',
			'user_default_listing_county' => 'County',
			'user_default_listing_country' => 'Country',
			'user_default_listing_zip_code' => 'Postal',
			'user_default_listing_tel' => 'Telephone',
			'user_default_listing_id' => 'Listing id',
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

		$criteria->compare('user_default_listing_address_id',$this->user_default_listing_address_id);
		$criteria->compare('user_default_listing_company_name',$this->user_default_listing_company_name,true);
		$criteria->compare('user_default_listing_address1',$this->user_default_listing_address1,true);
		$criteria->compare('user_default_listing_address2',$this->user_default_listing_address2,true);
		$criteria->compare('user_default_listing_address3',$this->user_default_listing_address3,true);
		$criteria->compare('user_default_listing_town',$this->user_default_listing_town,true);
		$criteria->compare('user_default_listing_county',$this->user_default_listing_county,true);
		$criteria->compare('user_default_listing_country',$this->user_default_listing_country,true);
		$criteria->compare('user_default_listing_zip_code',$this->user_default_listing_zip_code,true);
		$criteria->compare('user_default_listing_tel',$this->user_default_listing_tel,true);
		$criteria->compare('user_default_listing_id',$this->user_default_listing_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}