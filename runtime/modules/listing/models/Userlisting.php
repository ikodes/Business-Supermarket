<?php

/**
 * This is the model class for table "{{listing}}".
 *
 * The followings are the available columns in table '{{listing}}':
 * @property integer $user_default_listing_lid
 * @property string $user_default_listing_uid
 * @property string $user_default_listing_category_id
 * @property string $user_default_listing_profession
 * @property string $user_default_listing_viewlimit
 * @property string $user_default_listing_logo
 * @property string $user_default_listing_title
 * @property string $user_default_listing_desc
 * @property string $user_default_listing_explanation
 * @property string $user_default_listing_businessidea
 * @property string $user_default_listing_fprojections
 * @property string $user_default_listing_favailable
 * @property string $user_default_listing_famount
 * @property integer $user_default_listing_financial_data
 * @property string $user_default_listing_want
 * @property string $user_default_listing_keyword
 * @property string $user_default_listing_video1
 * @property string $user_default_listing_video2
 * @property string $user_default_listing_mktquestion
 * @property string $user_default_listing_mktqstatus
 * @property string $user_default_listing_reporttime
 * @property string $user_default_listing_date
 * @property string $user_default_listing_datetime
 * @property string $user_default_listing_status
 * @property string $user_default_listing_lstatus
 * @property string $user_default_listing_listtype
 * @property string $user_default_listing_company_name
 * @property string $user_default_listing_company_address1
 * @property string $user_default_listing_company_address2
 * @property string $user_default_listing_company_address3
 * @property string $user_default_listing_company_town
 * @property string $user_default_listing_company_county
 * @property string $user_default_listing_company_zip_code
 * @property string $user_default_listing_company_country
 * @property string $user_default_listing_company_tel_no
 * @property string $user_default_listing_company_fax_no
 * @property integer $user_default_listing_listingstatus
 * @property string $user_default_listing_approvedate
 * @property integer $reject_list
 */
class Userlisting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userlisting the static model class
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
		return '{{listing}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_profiles_id', 'required'),
			array('user_default_listing_notification_frequency,user_default_listing_id,user_default_listing_category_id,user_default_listing_lookingfor_id,user_default_listing_limit_viewing_id,user_default_listing_days_active,user_default_listing_days_inactive,user_default_listing_page_hits,user_default_profiles_id,user_default_listing_likes,user_default_listing_dislikes,user_default_listing_total_votes', 'numerical', 'integerOnly'=>true),
			array('user_default_listing_lookingfor_id, user_default_listing_limit_viewing_id, user_default_listing_thumbnail,user_default_listing_access_period', 'length', 'max'=>50),
			array('user_default_listing_summary,user_default_listing_fprojections', 'length', 'max'=>21845),
			array('user_default_listing_title,user_default_listing_approvedate,user_default_listing_date', 'length', 'max'=>100),
array('user_default_listing_details,user_default_listing_question', 'length', 'max'=>5592415 ),
array('user_default_listing_keywords', 'length', 'max'=>255 ),
array('user_default_listing_want', 'length', 'max'=>500 ),
array('user_default_listing_what_is_it', 'length', 'max'=>85 ),
array('user_default_listing_table_currency_code', 'length', 'max'=>3 ),
/*
array('user_default_listing_title, user_default_listing_desc, user_default_listing_company_town, user_default_listing_company_country, user_default_listing_approvedate', 'length', 'max'=>100),
			
			
			array('user_default_listing_summary, user_default_listing_want, user_default_listing_company_address1, user_default_listing_company_address2, user_default_listing_company_address3', 'length', 'max'=>500),
			array('user_default_listing_details, user_default_listing_listtype', 'length', 'max'=>1),
			array('user_default_listing_table_currency_code, user_default_listing_reporttime', 'length', 'max'=>10),
			array('user_default_listing_company_tel_no', 'length', 'max'=>30),
			*/
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_default_listing_id, user_default_listing_category_id, user_default_listing_lookingfor_id, user_default_listing_limit_viewing_id, user_default_listing_thumbnail, user_default_listing_title,user_default_listing_what_is_it, user_default_listing_summary,user_default_listing_details,user_default_listing_financial_table_status,user_default_listing_fprojections,user_default_listing_table_currency_code,user_default_listing_want,user_default_listing_keywords, user_default_listing_question, user_default_listing_notification_frequency,user_default_listing_submission_status,user_default_listing_days_active,user_default_listing_days_inactive,user_default_listing_page_hits,user_default_profiles_id,user_default_listing_likes,user_default_listing_dislikes,user_default_listing_total_votes,user_default_listing_access_period,user_default_listing_approvedate,user_default_listing_date', 'safe', 'on'=>'search'),
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
			'user_default_listing_id' => 'Lid',
			'user_default_listing_category_id' => ' Category',
			'user_default_listing_lookingfor_id' => ' Looking For',
			'user_default_listing_limit_viewing_id' => ' Viewlimit',
			'user_default_listing_thumbnail' => ' Logo',
			'user_default_listing_title' => ' Title',
			'user_default_listing_what_is_it' => ' What is it',
			'user_default_listing_summary' => ' Explanation',
			'user_default_listing_details' => ' Details',
			'user_default_listing_financial_table_status' => ' Financial table',
			'user_default_listing_table_currency_code' => ' Currency',
			'user_default_listing_want' => ' Want',
			'user_default_listing_keywords' => ' Keyword',
			'user_default_listing_question' => ' Question',
			'user_default_listing_notification_frequency' => ' Frequency',
			'user_default_listing_submission_status' => ' status',
			'user_default_listing_days_active' => ' DA',
			'user_default_listing_days_inactive' => ' DIA',
			'user_default_listing_page_hits' => ' Page Hits',			
			'user_default_profiles_id' => ' Uid',
			'user_default_listing_dislikes' => ' dislikes',
			'user_default_listing_total_votes' => ' votes',
			'user_default_listing_access_period' => ' access period',
			'user_default_listing_approvedate' => ' approve date',
			'user_default_listing_date' => ' Date',
			
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

		$criteria= new CDbCriteria;

		$criteria->compare('user_default_listing_id',$this->user_default_listing_id);
		//$criteria->compare('user_default_listing_category_id',$this->user_default_listing_category_id,true);
		$criteria->compare('user_default_listing_lookingfor_id',$this->user_default_listing_lookingfor_id,true);
		$criteria->compare('user_default_listing_limit_viewing_id',$this->user_default_listing_limit_viewing_id,true);
		$criteria->compare('user_default_listing_thumbnail',$this->user_default_listing_thumbnail,true);
		$criteria->compare('user_default_listing_title',$this->user_default_listing_title,true);
		$criteria->compare('user_default_listing_what_is_it',$this->user_default_listing_what_is_it,true);
		$criteria->compare('user_default_listing_summary',$this->user_default_listing_summary,true);
		$criteria->compare('user_default_listing_details',$this->user_default_listing_details,true);
		$criteria->compare('user_default_listing_financial_table_status',$this->user_default_listing_financial_table_status,true);
		$criteria->compare('user_default_listing_table_currency_code',$this->user_default_listing_table_currency_code,true);
		$criteria->compare('user_default_listing_want',$this->user_default_listing_want,true);
		$criteria->compare('user_default_listing_keywords',$this->user_default_listing_keywords);
		$criteria->compare('user_default_listing_question',$this->user_default_listing_question);
		$criteria->compare('user_default_listing_notification_frequency',$this->user_default_listing_notification_frequency,true);
		$criteria->compare('user_default_listing_submission_status',$this->user_default_listing_submission_status,true);
		$criteria->compare('user_default_listing_days_active',$this->user_default_listing_days_active,true);
		$criteria->compare('user_default_listing_days_inactive',$this->user_default_listing_days_inactive,true);
		$criteria->compare('user_default_listing_page_hits',$this->user_default_listing_page_hits,true);		
		$criteria->compare('user_default_profiles_id',$this->user_default_profiles_id,true);
		$criteria->compare('user_default_listing_likes',$this->user_default_listing_likes,true);
		$criteria->compare('user_default_listing_dislikes',$this->user_default_listing_dislikes,true);
		$criteria->compare('user_default_listing_total_votes',$this->user_default_listing_total_votes,true);
		$criteria->compare('user_default_listing_access_period',$this->user_default_listing_access_period,true);
		$criteria->compare('user_default_listing_approvedate',$this->user_default_listing_approvedate,true);
        $criteria->compare('user_default_listing_date',$this->user_default_listing_date,true);		
		$criteria->compare('user_default_profiles_id',Yii::app()->user->getState('uid'),true);        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getType($type_id=''){
		$data = array();
		switch ($this->user_default_listing_category_id) {
			case '1':
				$data['name'] = 'Business Services';
				$data['slug'] = 'business-services';
				break;
			case '2':
				$data['name'] = 'Business Ideas';
				$data['slug'] = 'business-ideas';
				break;
			case '3':
				$data['name'] = 'Retail';
				$data['slug'] = 'retail';
				break;
			case '4':
				$data['name'] = 'Industrial';
				$data['slug'] = 'industrial';
				break;
			case '5':
				$data['name'] = 'Science and Technology';
				$data['slug'] = 'science-and-technology';
				break;

			default:
				$data['name'] = 'User Listing';
				$data['slug'] = 'listing';
				break;
		}
		return $data;
	}
}