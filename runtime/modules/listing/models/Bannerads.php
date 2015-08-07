<?php

/**
 * This is the model class for table "{{banner_ads}}".
 *
 * The followings are the available columns in table '{{banner_ads}}':
 * @property string $banner_id
 * @property string $banner_path
 * @property integer $banner_duration
 * @property string $banner_cost
 * @property integer $banner_approve_status
 * @property string $banner_user_id
 * @property string $banner_subdate
 * @property integer $banner_clicks
 * @property string $banner_link
 * @property string $banner_adate
 */
class Bannerads extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bannerads the static model class
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
		return '{{banner_ads}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_listing_banner_submission_date, user_default_listing_banner_path, user_default_listing_banner_duration, user_default_listing_banner_cost, user_default_listing_banner_link, user_default_listing_banner_clicks', 'required'),
			array('user_default_listing_banner_id, user_default_id, user_default_listing_banner_status,user_default_listing_id', 'numerical', 'integerOnly'=>true),
		    // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_default_listing_banner_id, user_default_id, user_default_listing_banner_submission_date, user_default_listing_banner_path, user_default_listing_banner_duration, user_default_listing_banner_cost, user_default_listing_banner_status, user_default_listing_banner_link, user_default_listing_banner_clicks, user_default_listing_id', 'safe', 'on'=>'search'),
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
			'user_default_listing_banner_id' => 'Banner',
			'user_default_id' => 'User id',
			'user_default_listing_banner_submission_date' => 'Banner Submission date',
			'user_default_listing_banner_path' => 'Banner path',
			'user_default_listing_banner_duration' => 'Banner duration ',
			'user_default_listing_banner_cost' => 'banner cost',
			'user_default_listing_banner_status' => 'Banner Approve Status',
			'user_default_listing_banner_link' => 'Banner Link',
			'user_default_listing_banner_clicks' => 'Banner Clicks',
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

		$criteria->compare('user_default_listing_banner_id',$this->user_default_listing_banner_id,true);
		$criteria->compare('user_default_id',$this->user_default_id,true);
		$criteria->compare('user_default_listing_banner_submission_date',$this->user_default_listing_banner_submission_date);
		$criteria->compare('user_default_listing_banner_path',$this->user_default_listing_banner_path,true);
		$criteria->compare('user_default_listing_banner_duration',$this->user_default_listing_banner_duration);
		$criteria->compare('user_default_listing_banner_cost',$this->user_default_listing_banner_cost,true);
		$criteria->compare('user_default_listing_banner_status',$this->user_default_listing_banner_status,true);
		$criteria->compare('user_default_listing_banner_link',$this->user_default_listing_banner_link);
		$criteria->compare('user_default_listing_banner_clicks',$this->user_default_listing_banner_clicks,true);
		$criteria->compare('user_default_listing_id',$this->user_default_listing_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}