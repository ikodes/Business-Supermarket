
<?php


/**
 * This is the model class for table "{{listing}}".
 *
 * The followings are the available columns in table '{{listing}}':

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


 * @property string $user_default_listing_fprojections


 * @property string $user_default_listing_table_currency_code


 * @property string $user_default_listing_want


 * @property string $user_default_listing_keywords


 * @property string $user_default_listing_question


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


 * @property string $user_default_listing_date



 *
 * The followings are the available model relations:

 * @property BannerAds[] $bannerAds


 * @property Interactions[] $interactions


 * @property Profiles $userDefaultProfiles


 * @property ListingAddresses[] $listingAddresses


 * @property ListingImages[] $listingImages


 * @property ListingTableValues[] $listingTableValues


 * @property ListingVideos[] $listingVideoses


 * @property ListingVoiceYourOpinion[] $listingVoiceYourOpinions


 * @property PrizePoints[] $prizePoints



 */
class Listings extends CActiveRecord

{
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

			array('user_default_listing_category_id, user_default_listing_lookingfor_id, user_default_listing_limit_viewing_id, user_default_listing_thumbnail, user_default_listing_title, user_default_listing_what_is_it, user_default_listing_summary, user_default_listing_details, user_default_listing_financial_table_status, user_default_listing_fprojections, user_default_listing_question, user_default_profiles_id, user_default_listing_approvedate, user_default_listing_date', 'required'),


			array('user_default_listing_category_id, user_default_listing_lookingfor_id, user_default_listing_limit_viewing_id, user_default_listing_notification_frequency, user_default_listing_days_active, user_default_listing_days_inactive, user_default_listing_page_hits, user_default_profiles_id, user_default_listing_likes, user_default_listing_dislikes, user_default_listing_total_votes', 'numerical', 'integerOnly'=>true),


			array('user_default_listing_thumbnail, user_default_listing_access_period', 'length', 'max'=>45),


			array('user_default_listing_title, user_default_listing_approvedate, user_default_listing_date', 'length', 'max'=>100),


			array('user_default_listing_financial_table_status, user_default_listing_submission_status', 'length', 'max'=>1),


			array('user_default_listing_table_currency_code', 'length', 'max'=>3),


			array('user_default_listing_want', 'length', 'max'=>500),


			array('user_default_listing_keywords', 'length', 'max'=>255),


			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_default_listing_id, user_default_listing_category_id, user_default_listing_lookingfor_id, user_default_listing_limit_viewing_id, user_default_listing_thumbnail, user_default_listing_title, user_default_listing_what_is_it, user_default_listing_summary, user_default_listing_details, user_default_listing_financial_table_status, user_default_listing_fprojections, user_default_listing_table_currency_code, user_default_listing_want, user_default_listing_keywords, user_default_listing_question, user_default_listing_notification_frequency, user_default_listing_submission_status, user_default_listing_days_active, user_default_listing_days_inactive, user_default_listing_page_hits, user_default_profiles_id, user_default_listing_likes, user_default_listing_dislikes, user_default_listing_total_votes, user_default_listing_access_period, user_default_listing_approvedate, user_default_listing_date', 'safe', 'on'=>'search'),
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

			'bannerAds' => array(self::HAS_MANY, 'BannerAds', 'user_default_listing_id'),


			'interactions' => array(self::HAS_MANY, 'Interactions', 'user_default_listing_id'),


			'userDefaultProfiles' => array(self::BELONGS_TO, 'Profiles', 'user_default_profiles_id'),


			'listingAddresses' => array(self::HAS_MANY, 'ListingAddresses', 'user_default_listing_id'),


			'listingImages' => array(self::HAS_MANY, 'ListingImages', 'user_default_listing_id'),


			'listingTableValues' => array(self::HAS_MANY, 'ListingTableValues', 'user_default_listing_id'),


			'listingVideoses' => array(self::HAS_MANY, 'ListingVideos', 'user_default_listing_id'),


			'listingVoiceYourOpinions' => array(self::HAS_MANY, 'ListingVoiceYourOpinion', 'user_default_listing_id'),


			'prizePoints' => array(self::HAS_MANY, 'PrizePoints', 'user_default_listing_id'),


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


			'user_default_listing_fprojections' => 'User Default Listing Fprojections',


			'user_default_listing_table_currency_code' => 'User Default Listing Table Currency Code',


			'user_default_listing_want' => 'User Default Listing Want',


			'user_default_listing_keywords' => 'User Default Listing Keywords',


			'user_default_listing_question' => 'User Default Listing Question',


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


			'user_default_listing_date' => 'User Default Listing Date',


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
		$criteria->compare('user_default_listing_fprojections',$this->user_default_listing_fprojections,true);
		$criteria->compare('user_default_listing_table_currency_code',$this->user_default_listing_table_currency_code,true);
		$criteria->compare('user_default_listing_want',$this->user_default_listing_want,true);
		$criteria->compare('user_default_listing_keywords',$this->user_default_listing_keywords,true);
		$criteria->compare('user_default_listing_question',$this->user_default_listing_question,true);
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
		$criteria->compare('user_default_listing_date',$this->user_default_listing_date,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Listings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
