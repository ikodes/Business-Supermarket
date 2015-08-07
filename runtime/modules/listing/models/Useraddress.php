<?php



/**

 * This is the model class for table "{{addresses}}".

 *

 * The followings are the available columns in table '{{addresses}}':

 * @property integer $id

 * @property integer $user_id

 * @property integer $msg_id

 * @property integer $blist_id

 * @property integer $rating

 */

class Useraddress extends CActiveRecord

{

	/**

	 * @return string the associated database table name

	 */

	public function tableName()

	{

		return '{{addresses}}';

	}



	/**

	 * @return array validation rules for model attributes.

	 */

	public function rules()

	{

		// NOTE: you should only define rules for those attributes that

		// will receive user inputs.

		return array(

			array('user_default_profile_id, user_default_country', 'required'),

			array('user_default_address_id, user_default_profile_id', 'numerical', 'integerOnly'=>true),
            array('user_default_address1,user_default_address2,user_default_address3', 'length', 'max'=>255),
			array('user_default_zip', 'length', 'max'=>15),
			array('user_default_town , user_default_county , user_default_country ', 'length', 'max'=>100),
			// The following rule is used by search().

			// @todo Please remove those attributes that should not be searched.

			array('user_default_address_id, user_default_address1,user_default_address2,user_default_address3, user_default_town, user_default_county, user_default_country, user_default_zip, user_default_profile_id', 'safe', 'on'=>'search'),

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

			'user_default_address_id' => 'ID',

			'user_default_address1' => 'Address 1',
			
			'user_default_address2' => 'Address 2',
			
			'user_default_address3' => 'Address 3',

			'user_default_town' => 'Town',

			'user_default_county' => 'County',

			'user_default_country' => 'Country',

			'user_default_zip' => 'Zip',

			'user_default_profile_id' => 'User id',

		);

	}


	public function search()

	{

		// @todo Please modify the following code to remove attributes that should not be searched.



		$criteria=new CDbCriteria;



		$criteria->compare('user_default_address_id',$this->user_default_address_id);

		$criteria->compare('user_default_address1',$this->user_default_address1);
		
		$criteria->compare('user_default_address2',$this->user_default_address2);
		
		$criteria->compare('user_default_address3',$this->user_default_address3);

		$criteria->compare('user_default_town',$this->user_default_town);

		$criteria->compare('user_default_county',$this->user_default_county);

		$criteria->compare('user_default_country',$this->user_default_country);

		$criteria->compare('user_default_zip',$this->user_default_zip);

		$criteria->compare('user_default_profile_id',$this->user_default_profile_id);



		return new CActiveDataProvider($this, array(

			'criteria'=>$criteria,

		));

	}



	/**

	 * Returns the static model of the specified AR class.

	 * Please note that you should have this exact method in all your CActiveRecord descendants!

	 * @param string $className active record class name.

	 * @return Rating the static model class

	 */

	public static function model($className=__CLASS__)

	{

		return parent::model($className);

	}

}

