<?php

/**
 * This is the model class for table "{{business_listing}}".
 *
 * The followings are the available columns in table '{{business_listing}}':
 * @property integer $user_default_business_blid
 * @property string $user_default_business_id
 * @property string $user_default_business_category
 * @property string $user_default_business_profession
 * @property string $user_default_business_viewlimit
 * @property string $user_default_business_slogon
 * @property string $user_default_business_whoweare
 * @property string $user_default_business_offer
 * @property string $user_default_business_keyword
 * @property string $user_default_business_testimonial
 * @property string $user_default_business_datetime
 * @property string $user_default_business_status
 * @property string $user_default_business_lstatus
 * @property integer $approved
 */
class Businesslisting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Businesslisting the static model class
	 */

	public $co_name,$user_default_business_whoweare,$co_slogon,$user_default_business_image,$country,$user_default_business_last_page_visit,$user_default_business_page_visit,$user_default_business_whatwecando;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{business_listing}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_business_slogon,user_default_business_whoweare,user_default_business_offer,user_default_business_category,user_default_business_profession,user_default_business_whatwecando', 'required'),
			array('approved', 'numerical', 'integerOnly'=>true),
			array('user_default_business_id', 'length', 'max'=>100),
			array('user_default_business_title, user_default_business_category, user_default_business_profession, user_default_business_viewlimit, user_default_business_status, user_default_business_lstatus', 'length', 'max'=>50),
			array('user_default_business_slogon ', 'length', 'max'=>200),
			array('user_default_business_offer', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_default_business_blid, user_default_business_id, user_default_business_title, user_default_business_category, user_default_business_profession, user_default_business_viewlimit, user_default_business_slogon, user_default_business_whoweare, user_default_business_offer, user_default_business_keyword, user_default_business_testimonial, user_default_business_datetime, user_default_business_status, user_default_business_lstatus, approved,user_default_business_whatwecando,user_default_business_last_page_visit,user_default_business_page_visit', 'safe', 'on'=>'search'),
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
			'user_default_business_blid' => 'Blid',
			'user_default_business_id' => 'Uid',
			'user_default_business_title' => 'Title',
			'user_default_business_category' => 'Category',
			'user_default_business_profession' => 'Profession',
			'user_default_business_viewlimit' => 'Viewlimit',
			'user_default_business_slogon' => 'Slogon',
			'user_default_business_whoweare' => 'Whoweare',
			'user_default_business_offer' => 'Offer',
			'user_default_business_keyword' => 'Keyword',
			'user_default_business_testimonial' => 'Testimonial',
            'user_default_business_whatwecando' => 'What We Can Do',
			'user_default_business_datetime' => 'Datetime',
			'user_default_business_status' => 'Status',
			'user_default_business_lstatus' => 'Lstatus',
			'approved' => 'Approved',
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

		$criteria->compare('user_default_business_blid',$this->user_default_business_blid);
		$criteria->compare('user_default_business_id',$this->user_default_business_id,true);
		$criteria->compare('user_default_business_title',$this->user_default_business_title,true);
		$criteria->compare('user_default_business_category',$this->user_default_business_category,true);
		$criteria->compare('user_default_business_profession',$this->user_default_business_profession,true);
		$criteria->compare('user_default_business_viewlimit',$this->user_default_business_viewlimit,true);
		$criteria->compare('user_default_business_slogon',$this->user_default_business_slogon,true);
		$criteria->compare('user_default_business_whoweare',$this->user_default_business_whoweare,true);
		$criteria->compare('user_default_business_offer',$this->user_default_business_offer,true);
		$criteria->compare('user_default_business_keyword',$this->user_default_business_keyword,true);
		$criteria->compare('user_default_business_testimonial',$this->user_default_business_testimonial,true);
        $criteria->compare('user_default_business_whatwecando',$this->user_default_business_whatwecando,true);
		$criteria->compare('user_default_business_datetime',$this->user_default_business_datetime,true);
		$criteria->compare('user_default_business_status',$this->user_default_business_status,true);
		$criteria->compare('user_default_business_lstatus',$this->user_default_business_lstatus,true);
		$criteria->compare('approved',$this->approved);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}