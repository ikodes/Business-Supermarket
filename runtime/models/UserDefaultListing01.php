<?php

/**
 * This is the model class for table "user_default_listing".
 *
 * The followings are the available columns in table 'user_default_listing':
 * @property integer $user_default_listing_id
 * @property integer $user_default_listing_category_id
 * @property integer $user_default_listing_lookingfor_id
 * @property integer $user_default_listing_limit_viewing_id
 * @property string $user_default_listing_thumbnail
 * @property string $user_default_listing_title
 * @property string $user_default_listing_what_is_it
 * @property string $user_default_listing_summary
 * @property string $user_default_listing_details
 * @property string $user_default_listing_financial_table_status
 * @property string $user_default_listing_table_currency_code
 * @property string $user_default_listing_want
 * @property string $user_default_listing_keywords
 * @property integer $user_default_listing_notification_frequency
 * @property string $user_default_listing_submission_status
 * @property integer $user_default_listing_days_active
 * @property integer $user_default_listing_days_inactive
 * @property integer $user_default_listing_page_hits
 * @property integer $user_default_profiles_id
 * @property integer $user_default_listing_likes
 * @property integer $user_default_listing_dislikes
 * @property integer $user_default_listing_total_votes
 * @property string $user_default_listing_access_period
 * @property string $user_default_listing_approvedate
 */
class UserDefaultListing extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_default_listing';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_listing_category_id, user_default_listing_lookingfor_id, user_default_listing_limit_viewing_id, user_default_listing_thumbnail, user_default_listing_title, user_default_listing_what_is_it, user_default_listing_summary, user_default_listing_details, user_default_listing_financial_table_status, user_default_profiles_id, user_default_listing_approvedate', 'required'),
			array('user_default_listing_category_id, user_default_listing_lookingfor_id, user_default_listing_limit_viewing_id, user_default_listing_notification_frequency, user_default_listing_days_active, user_default_listing_days_inactive, user_default_listing_page_hits, user_default_profiles_id, user_default_listing_likes, user_default_listing_dislikes, user_default_listing_total_votes', 'numerical', 'integerOnly'=>true),
			array('user_default_listing_thumbnail, user_default_listing_access_period', 'length', 'max'=>45),
			array('user_default_listing_title, user_default_listing_approvedate', 'length', 'max'=>100),
			array('user_default_listing_financial_table_status, user_default_listing_submission_status', 'length', 'max'=>1),
			array('user_default_listing_table_currency_code', 'length', 'max'=>3),
			array(' user_default_listing_keywords', 'length', 'max'=>255),
			array('user_default_listing_want', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_default_listing_id, user_default_listing_category_id, user_default_listing_lookingfor_id, user_default_listing_limit_viewing_id, user_default_listing_thumbnail, user_default_listing_title, user_default_listing_what_is_it, user_default_listing_summary, user_default_listing_details, user_default_listing_financial_table_status, user_default_listing_table_currency_code, user_default_listing_want, user_default_listing_keywords, user_default_listing_notification_frequency, user_default_listing_submission_status, user_default_listing_days_active, user_default_listing_days_inactive, user_default_listing_page_hits, user_default_profiles_id, user_default_listing_likes, user_default_listing_dislikes, user_default_listing_total_votes, user_default_listing_access_period, user_default_listing_approvedate', 'safe', 'on'=>'search'),
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
			'user_default_listing_id' => 'User Default Listing',
			'user_default_listing_category_id' => 'User Default Listing Category',
			'user_default_listing_lookingfor_id' => 'User Default Listing Lookingfor',
			'user_default_listing_limit_viewing_id' => 'User Default Listing Limit Viewing',
			'user_default_listing_thumbnail' => 'User Default Listing Thumbnail',
			'user_default_listing_title' => 'User Default Listing Title',
			'user_default_listing_what_is_it' => 'User Default Listing What Is It',
			'user_default_listing_summary' => 'User Default Listing Summary',
			'user_default_listing_details' => 'User Default Listing Details',
			'user_default_listing_financial_table_status' => 'User Default Listing Financial Table Status',
			'user_default_listing_table_currency_code' => 'User Default Listing Table Currency Code',
			'user_default_listing_want' => 'User Default Listing Want',
			'user_default_listing_keywords' => 'User Default Listing Keywords',
			'user_default_listing_notification_frequency' => 'User Default Listing Notification Frequency',
			'user_default_listing_submission_status' => 'User Default Listing Submission Status',
			'user_default_listing_days_active' => 'User Default Listing Days Active',
			'user_default_listing_days_inactive' => 'User Default Listing Days Inactive',
			'user_default_listing_page_hits' => 'User Default Listing Page Hits',
			'user_default_profiles_id' => 'User Default Profiles',
			'user_default_listing_likes' => 'User Default Listing Likes',
			'user_default_listing_dislikes' => 'User Default Listing Dislikes',
			'user_default_listing_total_votes' => 'User Default Listing Total Votes',
			'user_default_listing_access_period' => 'User Default Listing Access Period',
			'user_default_listing_approvedate' => 'User Default Listing Approvedate',
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

		$criteria->compare('user_default_listing_id',$this->user_default_listing_id);
		$criteria->compare('user_default_listing_category_id',$this->user_default_listing_category_id);
		$criteria->compare('user_default_listing_lookingfor_id',$this->user_default_listing_lookingfor_id);
		$criteria->compare('user_default_listing_limit_viewing_id',$this->user_default_listing_limit_viewing_id);
		$criteria->compare('user_default_listing_thumbnail',$this->user_default_listing_thumbnail,true);
		$criteria->compare('user_default_listing_title',$this->user_default_listing_title,true);
		$criteria->compare('user_default_listing_what_is_it',$this->user_default_listing_what_is_it,true);
		$criteria->compare('user_default_listing_summary',$this->user_default_listing_summary,true);
		$criteria->compare('user_default_listing_details',$this->user_default_listing_details,true);
		$criteria->compare('user_default_listing_financial_table_status',$this->user_default_listing_financial_table_status,true);
		$criteria->compare('user_default_listing_table_currency_code',$this->user_default_listing_table_currency_code,true);
		$criteria->compare('user_default_listing_want',$this->user_default_listing_want,true);
		$criteria->compare('user_default_listing_keywords',$this->user_default_listing_keywords,true);
		$criteria->compare('user_default_listing_notification_frequency',$this->user_default_listing_notification_frequency);
		$criteria->compare('user_default_listing_submission_status',$this->user_default_listing_submission_status,true);
		$criteria->compare('user_default_listing_days_active',$this->user_default_listing_days_active);
		$criteria->compare('user_default_listing_days_inactive',$this->user_default_listing_days_inactive);
		$criteria->compare('user_default_listing_page_hits',$this->user_default_listing_page_hits);
		$criteria->compare('user_default_profiles_id',$this->user_default_profiles_id);
		$criteria->compare('user_default_listing_likes',$this->user_default_listing_likes);
		$criteria->compare('user_default_listing_dislikes',$this->user_default_listing_dislikes);
		$criteria->compare('user_default_listing_total_votes',$this->user_default_listing_total_votes);
		$criteria->compare('user_default_listing_access_period',$this->user_default_listing_access_period,true);
		$criteria->compare('user_default_listing_approvedate',$this->user_default_listing_approvedate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserDefaultListing the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	 public static function homeSearch($keyword,$searchCriteria,$searchViewOffset,$searchViewLimit,$orderBy){
         $Criteria = new CDbCriteria();

        if($searchCriteria=='all') {
            $Data = User::model()->findAll("user_default_username like '%".addslashes($keyword)."%'");

            if($Data){

                foreach($Data as $rsData){
                    $ids = $rsData->user_default_id.',';
                }
                $ids1 = rtrim($ids,',');

                $Criteria->addInCondition('user_default_profiles_id',array($ids1),$operator='OR');
            }
	
            $Criteria->addCondition('user_default_listing_title LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_what_is_it LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_summary LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_details LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_financial_table_status LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_table_currency_code LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_want LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_keywords LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_notification_frequency LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_submission_status LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_days_active LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_days_inactive LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_page_hits LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_likes LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_dislikes LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_total_votes LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_access_period LIKE "%'.$keyword.'%"',$operator='OR');
			
        }else if($searchCriteria=='key'){
            $Criteria->addCondition('user_default_listing_keywords LIKE "%'.$keyword.'%"');
        }
        else if($searchCriteria=='title'){
            $Criteria->addCondition('user_default_listing_title LIKE "%'.$keyword.'%"');
        }
        $Criteria->addCondition('user_default_listing_submission_status=1',$operator='OR');


        if($orderBy == 'user_default_listing_approvedate ASC')
        {
            $Criteria->order = 'user_default_listing_approvedate ASC';
        }
        if($orderBy == 'user_default_listing_approvedate DESC')
        {
            $Criteria->order = 'user_default_listing_approvedate DESC';
        }

        $Criteria->limit=$searchViewLimit;
        $Criteria->offset=$searchViewOffset;

        $result = UserDefaultListing::model()->findAll($Criteria);
        return $result;
    }

    public static function allListingData( $searchViewOffset, $searchViewLimit, $orderBy){
        $Criteria = new CDbCriteria();

        if($orderBy == 'user_default_listing_approvedate ASC')
        {
            $Criteria->order = 'user_default_listing_approvedate ASC';
        }
        if($orderBy == 'user_default_listing_approvedate DESC')
        {
            $Criteria->order = 'user_default_listing_approvedate DESC';
        }

        $Criteria->limit=$searchViewLimit;
        $Criteria->offset=$searchViewOffset;

        $result = UserDefaultListing::model()->findAll($Criteria);
        return $result;

    }

    public static function countByHomeSearch($keyword,$searchCriteria,$orderBy){
        $Criteria = new CDbCriteria();
        if($searchCriteria=='all') {
            $Data = User::model()->findAll("user_default_username like '%".addslashes($keyword)."%'");

            if($Data){

                foreach($Data as $rsData){
                    $ids = $rsData->user_default_id.',';
                }
                $ids1 = rtrim($ids,',');

                $Criteria->addInCondition('user_default_profiles_id',array($ids1),$operator='OR');
            }

            $Criteria->addCondition('user_default_listing_title LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_what_is_it LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_summary LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_details LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_financial_table_status LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_table_currency_code LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_want LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_keywords LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_notification_frequency LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_submission_status LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_days_active LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_days_inactive LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_page_hits LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_likes LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_dislikes LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_total_votes LIKE "%'.$keyword.'%"',$operator='OR');
            $Criteria->addCondition('user_default_listing_access_period LIKE "%'.$keyword.'%"',$operator='OR');

        }else if($searchCriteria=='key'){
            $Criteria->addCondition('user_default_listing_keywords LIKE "%'.$keyword.'%"');
        }
        else if($searchCriteria=='title'){
            $Criteria->addCondition('user_default_listing_title LIKE "%'.$keyword.'%"');
        }
        $Criteria->addCondition('user_default_listing_submission_status=1',$operator='OR');


        if($orderBy == 'user_default_listing_approvedate ASC')
        {
            $Criteria->order = 'user_default_listing_approvedate ASC';
        }
        if($orderBy == 'user_default_listing_approvedate DESC')
        {
            $Criteria->order = 'user_default_listing_approvedate DESC';
        }

        $result = UserDefaultListing::model()->findAll($Criteria);
        return sizeof($result);
    }

    public static function getTotalComments(){

        $sql = "SELECT COUNT(*) as total_comments ";
        $sql .= "FROM {{user_default_listing}} c ";

        $totalComments = Yii::app()->db->createCommand($sql)->queryAll();

        return (int) $totalComments[0]['total_comments'];

    }
}
