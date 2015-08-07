<?php

/**
 * This is the model class for table "{{country}}".
 *
 * The followings are the available columns in table '{{country}}':
 * @property integer $country_id
 * @property string $country
 */
class Favourites extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Country the static model class
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
		return '{{interactions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_profile_id, user_default_listing_id', 'required'),
			// array('country', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_default_interaction_id,user_default_reputation,user_default_favourites,user_default_profile_id, user_default_listing_id', 'safe', 'on'=>'search'),
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
			'user_default_interaction_id' => 'ID',
			'user_default_reputation' => 'Reputation',						'user_default_favourites' => 'Favourite',						'user_default_profile_id' => 'User',			'user_default_listing_id' => 'Listing',			
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
	   $criteria->compare('user_default_interaction_id',$this->user_default_interaction_id);		$criteria->compare('user_default_reputation',$this->user_default_reputation);				$criteria->compare('user_default_favourites',$this->user_default_favourites);
		$criteria->compare('user_default_profile_id',$this->user_default_profile_id);
		$criteria->compare('user_default_listing_id',$this->user_default_listing_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}