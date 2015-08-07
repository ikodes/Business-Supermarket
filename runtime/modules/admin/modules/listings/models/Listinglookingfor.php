<?php

/**
 * This is the model class for table "{{listing_lookingfor}}".
 *
 * The followings are the available columns in table '{{listing_lookingfor}}':
 * @property integer $lookingfor_id
 * @property string $lookingfor_name
 * @property string $lookingfor_title
 * @property integer $sort_order
 */
class Listinglookingfor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Listinglookingfor the static model class
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
			array('user_default_listing_sort_order', 'numerical', 'integerOnly'=>true),
			array('user_default_listing_lookingfor_name, user_default_listing_lookingfor_title', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
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
			'user_default_listing_lookingfor_id' => 'Lookingfor',
			'user_default_listing_lookingfor_name' => 'Lookingfor Name',
			'user_default_listing_lookingfor_title' => 'Lookingfor Title',
			'user_default_listing_lookingfor_sort_order' => 'Sort Order',
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

		$criteria->compare('user_default_listing_lookingfor_id',$this->user_default_listing_lookingfor_id);
		$criteria->compare('user_default_listing_lookingfor_name',$this->user_default_listing_lookingfor_name,true);
		$criteria->compare('user_default_listing_lookingfor_title',$this->user_default_listing_lookingfor_title,true);
		$criteria->compare('user_default_listing_lookingfor_sort_order',$this->user_default_listing_lookingfor_sort_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getRowTitle($id){
		$row = self::model()->findByPk($id);
		return $row->lookingfor_name;
	}
}