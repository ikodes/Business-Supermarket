<?php

/**
 * This is the model class for table "{{like_message}}".
 *
 * The followings are the available columns in table '{{like_message}}':
 * @property string $id
 * @property string $msg_id
 * @property string $user_id
 * @property string $like_message
 * @property string $date_create
 * @property string $date_update
 */
class LikeMessage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{like_message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	/*public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('msg_id, user_id', 'required'),
			array('msg_id, user_id', 'length', 'max'=>11),
			array('like_message', 'length', 'max'=>1),
			array('date_create, date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, msg_id, user_id, like_message, date_create, date_update', 'safe', 'on'=>'search'),
		);
	}
    */
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
			'msg_id' => 'Msg',
			'user_id' => 'User',
			'like_message' => 'Like Message',
			'date_create' => 'Date Create',
			'date_update' => 'Date Update',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('msg_id',$this->msg_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('like_message',$this->like_message,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_update',$this->date_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LikeMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
