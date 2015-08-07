
<?php


/**
 * This is the model class for table "{{prize_points}}".
 *
 * The followings are the available columns in table '{{prize_points}}':

 * @property integer $user_default_prize_points_id


 * @property integer $user_default_listing_points_purchased


 * @property string $user_default_listing_points_cost


 * @property string $user_default_listing_points_date


 * @property string $user_default_listing_points_time


 * @property integer $user_default_listing_points_required


 * @property integer $user_default_listing_points_user_id


 * @property integer $user_default_listing_id



 *
 * The followings are the available model relations:

 * @property Listing $userDefaultListing


 * @property Profiles $userDefaultListingPointsUser



 */
class PrizePoints extends CActiveRecord

{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{prize_points}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('user_default_listing_points_purchased, user_default_listing_points_cost, user_default_listing_points_date, user_default_listing_points_time, user_default_listing_points_user_id, user_default_listing_id', 'required'),


			array('user_default_listing_points_purchased, user_default_listing_points_required, user_default_listing_points_user_id, user_default_listing_id', 'numerical', 'integerOnly'=>true),


			array('user_default_listing_points_cost', 'length', 'max'=>10),


			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_default_prize_points_id, user_default_listing_points_purchased, user_default_listing_points_cost, user_default_listing_points_date, user_default_listing_points_time, user_default_listing_points_required, user_default_listing_points_user_id, user_default_listing_id', 'safe', 'on'=>'search'),
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

			'userDefaultListing' => array(self::BELONGS_TO, 'Listing', 'user_default_listing_id'),


			'userDefaultListingPointsUser' => array(self::BELONGS_TO, 'Profiles', 'user_default_listing_points_user_id'),


		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(

			'user_default_prize_points_id' => 'User Default Prize Points',


			'user_default_listing_points_purchased' => 'User Default Listing Points Purchased',


			'user_default_listing_points_cost' => 'User Default Listing Points Cost',


			'user_default_listing_points_date' => 'User Default Listing Points Date',


			'user_default_listing_points_time' => 'User Default Listing Points Time',


			'user_default_listing_points_required' => 'User Default Listing Points Required',


			'user_default_listing_points_user_id' => 'User Default Listing Points User',


			'user_default_listing_id' => 'User Default Listing',


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

		$criteria->compare('user_default_prize_points_id',$this->user_default_prize_points_id);
		$criteria->compare('user_default_listing_points_purchased',$this->user_default_listing_points_purchased);
		$criteria->compare('user_default_listing_points_cost',$this->user_default_listing_points_cost,true);
		$criteria->compare('user_default_listing_points_date',$this->user_default_listing_points_date,true);
		$criteria->compare('user_default_listing_points_time',$this->user_default_listing_points_time,true);
		$criteria->compare('user_default_listing_points_required',$this->user_default_listing_points_required);
		$criteria->compare('user_default_listing_points_user_id',$this->user_default_listing_points_user_id);
		$criteria->compare('user_default_listing_id',$this->user_default_listing_id);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PrizePoints the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
