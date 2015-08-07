<?php

/**
 * This is the model class for table "{{log_transaction}}".
 *
 * The followings are the available columns in table '{{log_transaction}}':
 * @property integer $transaction_id
 * @property integer $user_default_id
 * @property integer $log_id
 * @property string $transaction_description
 * @property string $transaction_date
 */
class Logtransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Logtransaction the static model class
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
		return '{{log_transaction}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_id, log_id, transaction_description, transaction_date', 'required'),
			array('user_default_id, log_id', 'numerical', 'integerOnly'=>true),
			array('transaction_description', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('transaction_id, user_default_id, log_id, transaction_description, transaction_date', 'safe', 'on'=>'search'),
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
			'transaction_id' => 'Transaction',
			'user_default_id' => 'Member',
			'log_id' => 'Log',
			'transaction_description' => 'Transaction Description',
			'transaction_date' => 'Transaction Date',
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

		$criteria->compare('transaction_id',$this->transaction_id);
		$criteria->compare('user_default_id',$this->user_default_id);
		$criteria->compare('log_id',$this->log_id);
		$criteria->compare('transaction_description',$this->transaction_description,true);
		$criteria->compare('transaction_date',$this->transaction_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function totalLoggedTime($user_default_id)
	{
		$loginCount = Logtransaction::model()->findAllByAttributes(array('user_default_id' => $user_default_id),array('order'=>'transaction_id'));                         
		if($loginCount){ 
		     $monthDate =  SharedFunctions::app()->first_last_date(time());
		     $i=0;$j=0;
		     $dateArray1 = 0;
		     foreach($loginCount as $val){                                    
		           if($monthDate[0]<= strtotime($val->transaction_date) &&  $monthDate[1] >= strtotime($val->transaction_date)){
		               if($val->log_id==2){ 
		                     $dateArray[$i]  = $val->transaction_date;                                                 
		               }else if($val->log_id==3){
		                   $dateArray1   = (strtotime($val->transaction_date) - strtotime($dateArray[$i-1])); 
		               }
		           }
		           $i++;                      
		     } 
		    $average = $dateArray1/date('t') ; 
		    $average = ($average>0)? date("h:i:s",$average):'0' ;
		    return array('total' =>date("h:i:s",$dateArray1),'average'=>$average); 
		}else
			return array('total' =>0,'average' =>0);
	}
}