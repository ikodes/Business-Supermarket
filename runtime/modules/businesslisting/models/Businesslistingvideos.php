<?php

/**
 * This is the model class for table "{{blisting_videos}}".
 *
 * The followings are the available columns in table '{{blisting_videos}}':
 * @property integer $user_default_business_video_id
 * @property string $user_default_business_videodesc
 * @property string $user_default_business_listing_video
 * @property integer $user_default_business_blid
 */
class Businesslistingvideos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Businesslistingvideos the static model class
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
		return '{{business_listing_videos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_business_videodesc, user_default_business_listing_video, user_default_business_blid', 'required'),
			array('user_default_business_blid', 'numerical', 'integerOnly'=>true),
			array('user_default_business_videodesc', 'length', 'max'=>250),
			array('user_default_business_listing_video', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_default_business_video_id, user_default_business_videodesc, user_default_business_listing_video,user_default_business_listing_video_type, user_default_business_blid', 'safe', 'on'=>'search'),
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
			'user_default_business_video_id' => 'Business Video',
			'user_default_business_videodesc' => 'Business Videodesc',
			'user_default_business_listing_video' => 'Business Listing Video',
			'user_default_business_listing_video_type' => 'Business Video Type',
			'user_default_business_blid' => 'Business Blid',
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

		$criteria->compare('user_default_business_video_id',$this->user_default_business_video_id);
		$criteria->compare('user_default_business_videodesc',$this->user_default_business_videodesc,true);
		$criteria->compare('user_default_business_listing_video',$this->user_default_business_listing_video,true);
		$criteria->compare('user_default_business_listing_video_type',$this->user_default_business_listing_video_type,true);
		$criteria->compare('user_default_business_blid',$this->user_default_business_blid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}