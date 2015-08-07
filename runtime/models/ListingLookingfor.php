<?php

/**
 * This is the model class for table "{{listing_lookingfor}}".
 *
 * The followings are the available columns in table '{{listing_lookingfor}}':
 * @property integer $user_default_listing_lookingfor_id
 * @property string $user_default_listing_lookingfor_name
 * @property string $user_default_listing_lookingfor_title
 * @property integer $user_default_listing_lookingfor_sort_order
 */
class ListingLookingfor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{listing_lookingfor}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_listing_lookingfor_name, user_default_listing_lookingfor_title, user_default_listing_lookingfor_sort_order', 'required'),
			array('user_default_listing_lookingfor_sort_order', 'numerical', 'integerOnly'=>true),
			array('user_default_listing_lookingfor_name, user_default_listing_lookingfor_title', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_default_listing_lookingfor_id, user_default_listing_lookingfor_name, user_default_listing_lookingfor_title, user_default_listing_lookingfor_sort_order', 'safe', 'on'=>'search'),
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
			'user_default_listing_lookingfor_id' => 'User Default Listing Lookingfor',
			'user_default_listing_lookingfor_name' => 'User Default Listing Lookingfor Name',
			'user_default_listing_lookingfor_title' => 'User Default Listing Lookingfor Title',
			'user_default_listing_lookingfor_sort_order' => 'User Default Listing Lookingfor Sort Order',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_default_listing_lookingfor_id',$this->user_default_listing_lookingfor_id);
		$criteria->compare('user_default_listing_lookingfor_name',$this->user_default_listing_lookingfor_name,true);
		$criteria->compare('user_default_listing_lookingfor_title',$this->user_default_listing_lookingfor_title,true);
		$criteria->compare('user_default_listing_lookingfor_sort_order',$this->user_default_listing_lookingfor_sort_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ListingLookingfor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
