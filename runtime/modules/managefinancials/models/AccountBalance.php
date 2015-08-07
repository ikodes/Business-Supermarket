
<?php


/**
 * This is the model class for table "{{account_balance}}".
 *
 * The followings are the available columns in table '{{account_balance}}':

 * @property integer $user_default_account_balance_id


 * @property integer $user_default_account_balance_user_id


 * @property string $user_default_account_balance_account_balance


 * @property string $user_default_account_balance_currency_code



 */
class AccountBalance extends CActiveRecord

{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{account_balance}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('user_default_account_balance_user_id, user_default_account_balance_account_balance, user_default_account_balance_currency_code', 'required'),


			array('user_default_account_balance_user_id', 'numerical', 'integerOnly'=>true),


			array('user_default_account_balance_account_balance', 'length', 'max'=>10),


			array('user_default_account_balance_currency_code', 'length', 'max'=>3),


			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_default_account_balance_id, user_default_account_balance_user_id, user_default_account_balance_account_balance, user_default_account_balance_currency_code', 'safe', 'on'=>'search'),
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

			'user_default_account_balance_id' => 'User Default Account Balance',


			'user_default_account_balance_user_id' => 'User Default Account Balance User',


			'user_default_account_balance_account_balance' => 'User Default Account Balance Account Balance',


			'user_default_account_balance_currency_code' => 'User Default Account Balance Currency Code',


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

		$criteria->compare('user_default_account_balance_id',$this->user_default_account_balance_id);
		$criteria->compare('user_default_account_balance_user_id',$this->user_default_account_balance_user_id);
		$criteria->compare('user_default_account_balance_account_balance',$this->user_default_account_balance_account_balance,true);
		$criteria->compare('user_default_account_balance_currency_code',$this->user_default_account_balance_currency_code,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AccountBalance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
