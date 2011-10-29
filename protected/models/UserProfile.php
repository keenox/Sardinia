<?php

/**
 * This is the model class for table "user_profile".
 *
 * The followings are the available columns in table 'user_profile':
 * @property integer $id
 * @property string $fname
 * @property string $lname
 * @property string $gender
 * @property integer $ref_id
 * @property string $country
 * @property integer $postcode
 * @property string $state
 * @property string $address
 * @property string $phone
 * @property string $date_of_birth
 * @property string $date_registered
 * @property string $security
 * @property string $answer
 * @property string $subscription
 * @property integer $ewallet
 *
 * The followings are the available model relations:
 * @property User $user
 * @property User $id0
 */
class UserProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserProfile the static model class
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
		return 'user_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fname, lname'/*, gender, country, postcode, state, address, phone, date_of_birth, security, answer'*/, 'required'),
			array('ref_id, postcode', 'numerical', 'integerOnly'=>true),
			array('ewallet', 'numerical', 'integerOnly'=>false),
			array('fname, lname', 'length', 'max'=>80),
			array('gender', 'length', 'max'=>1),
			array('country', 'length', 'max'=>2),
			array('state, phone', 'length', 'max'=>20),
			array('address', 'length', 'max'=>120),
			array('security, answer, subscription', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fname, lname, gender, ref_id, country, postcode, state, address, phone, date_of_birth, date_registered, security, answer, subscription, ewallet', 'safe'/*, 'on'=>'search'*/),
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
			'user' => array(self::HAS_ONE, 'User', 'id'),
			'id0' => array(self::BELONGS_TO, 'User', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fname' => 'Fname',
			'lname' => 'Lname',
			'gender' => 'Gender',
			'ref_id' => 'Ref',
			'country' => 'Country',
			'postcode' => 'Postcode',
			'state' => 'State',
			'address' => 'Address',
			'phone' => 'Phone',
			'date_of_birth' => 'Date Of Birth',
			'date_registered' => 'Date Registered',
			'security' => 'Security',
			'answer' => 'Answer',
			'subscription' => 'Subscription',
			'ewallet' => 'Ewallet',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('ref_id',$this->ref_id);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('postcode',$this->postcode);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('date_registered',$this->date_registered,true);
		$criteria->compare('security',$this->security,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('subscription',$this->subscription,true);
		$criteria->compare('ewallet',$this->ewallet);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}