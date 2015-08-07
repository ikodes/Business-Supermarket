<?php

/**
 * This is the model class for table "{{listing_category}}".
 *
 * The followings are the available columns in table '{{listing_category}}':
 * @property integer $user_default_listing_category_id
 * @property string $user_default_listing_category_name
 * @property string $user_default_listing_category_title
 * @property integer $user_default_listing_category_sort_order
 */
class ListingCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{listing_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_listing_category_name, user_default_listing_category_title, user_default_listing_category_sort_order', 'required'),
			array('user_default_listing_category_sort_order', 'numerical', 'integerOnly'=>true),
			array('user_default_listing_category_name', 'length', 'max'=>100),
			array('user_default_listing_category_title', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_default_listing_category_id, user_default_listing_category_name, user_default_listing_category_title, user_default_listing_category_sort_order', 'safe', 'on'=>'search'),
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
			'user_default_listing_category_id' => 'User Default Listing Category',
			'user_default_listing_category_name' => 'User Default Listing Category Name',
			'user_default_listing_category_title' => 'User Default Listing Category Title',
			'user_default_listing_category_sort_order' => 'User Default Listing Category Sort Order',
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

		$criteria->compare('user_default_listing_category_id',$this->user_default_listing_category_id);
		$criteria->compare('user_default_listing_category_name',$this->user_default_listing_category_name,true);
		$criteria->compare('user_default_listing_category_title',$this->user_default_listing_category_title,true);
		$criteria->compare('user_default_listing_category_sort_order',$this->user_default_listing_category_sort_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ListingCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
