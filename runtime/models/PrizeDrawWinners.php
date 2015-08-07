<?php

/**
 * This is the model class for table "{{prize_draw_winners}}".
 *
 * The followings are the available columns in table '{{prize_draw_winners}}':
 * @property integer $id
 * @property string $user_id
 * @property string $date_draw
 * @property string $prize_won_amount
 * @property string $amount_paid_date
 * @property string $payment_ref
 */
class PrizeDrawWinners extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{prize_draw_winners}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, date_draw, prize_won_amount, amount_paid_date, payment_ref', 'required'),
			array('user_id', 'length', 'max'=>25),
			array('prize_won_amount', 'length', 'max'=>10),
			array('payment_ref', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, date_draw, prize_won_amount, amount_paid_date, payment_ref', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'user_id' => 'User',
			'date_draw' => 'Date Draw',
			'prize_won_amount' => 'Prize Won Amount',
			'amount_paid_date' => 'Amount Paid Date',
			'payment_ref' => 'Payment Ref',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('date_draw',$this->date_draw,true);
		$criteria->compare('prize_won_amount',$this->prize_won_amount,true);
		$criteria->compare('amount_paid_date',$this->amount_paid_date,true);
		$criteria->compare('payment_ref',$this->payment_ref,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PrizeDrawWinners the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
