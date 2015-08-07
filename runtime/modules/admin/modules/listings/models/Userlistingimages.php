<?php

/**
 * This is the model class for table "{{listing_images}}".
 *
 * The followings are the available columns in table '{{listing_images}}':
 * @property integer $user_default_listing_image_id
 * @property string $user_default_listing_image
 * @property string $user_default_listing_image_text 
 * @property string $user_default_listing_image_link1 
 * @property string $user_default_listing_image_link2
 * @property integer $user_default_listing_id
 * @property integer $order_id
 */
class Userlistingimages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userlistingimages the static model class
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
		return '{{listing_images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_listing_image, user_default_listing_image_text, user_default_listing_id,', 'required'),
			array('user_default_listing_id', 'numerical', 'integerOnly'=>true),
			array('user_default_listing_image', 'length', 'max'=>250),
			array('user_default_listing_image_text', 'length', 'max'=>500),				
			array('user_default_listing_image_link1', 'length', 'max'=>500),		
			array('user_default_listing_image_link2', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_default_listing_image_id, user_default_listing_image, user_default_listing_image_text, user_default_listing_image_link1, user_default_listing_image_link2, user_default_listing_id, order_id', 'safe', 'on'=>'search'),
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
			'user_default_listing_image_id' => 'Drg Image',
			'user_default_listing_image' => 'Drg Listing Image',
			'user_default_listing_image_text' => 'Drg Imgdesc',				
			'user_default_listing_image_link1' => 'Drg Sitelink',		
			'user_default_listing_image_link2' => 'Drg Videolink',
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

		$criteria->compare('user_default_listing_image_id',$this->user_default_listing_image_id);
		$criteria->compare('user_default_listing_image',$this->user_default_listing_image,true);
		$criteria->compare('user_default_listing_image_text',$this->user_default_listing_image_text,true);	
		$criteria->compare('user_default_listing_image_link1',$this->user_default_listing_image_link1,true);	
  		$criteria->compare('user_default_listing_image_link2',$this->user_default_listing_image_link2,true);
		$criteria->compare('user_default_listing_id',$this->user_default_listing_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}