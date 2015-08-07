<?php

/**
 * This is the model class for table "{{listing_videos}}".
 *
 * The followings are the available columns in table '{{listing_videos}}':
 * @property integer $user_default_listing_video_id
 * @property string $user_default_listing_video_link
 * @property string $user_default_listing_video_user_uploaded
 * @property integer $user_default_listing_id
 */
class Userlistingvideos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userlistingvideos the static model class
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
		return '{{listing_videos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_listing_video_link, user_default_listing_id', 'required'),
			array('user_default_listing_id', 'numerical', 'integerOnly'=>true),
			array('user_default_listing_video_link', 'length', 'max'=>250),
			array('user_default_listing_video_user_uploaded', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_default_listing_video_id, user_default_listing_video_link, user_default_listing_video_user_uploaded,user_default_listing_video_type, user_default_listing_id', 'safe', 'on'=>'search'),
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
			'user_default_listing_video_id' => 'Drg Video',
			'user_default_listing_video_link' => 'Drg Videodesc',
			'user_default_listing_video_user_uploaded' => 'Drg Listing Video',
			'user_default_listing_video_type' => 'Drg video type',
			'user_default_listing_id' => 'Drg Lid',
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

		$criteria->compare('user_default_listing_video_id',$this->user_default_listing_video_id);
		$criteria->compare('user_default_listing_video_link',$this->user_default_listing_video_link,true);
		$criteria->compare('user_default_listing_video_user_uploaded',$this->user_default_listing_video_user_uploaded,true);
		$criteria->compare('user_default_listing_video_type',$this->user_default_listing_video_type,true);
		$criteria->compare('user_default_listing_id',$this->user_default_listing_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}