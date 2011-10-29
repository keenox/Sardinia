<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $user
 * @property string $pass
 * @property string $email
 * @property string $status
 * @property integer $verified
 * @property integer $confirmed
 * @property string $hash
 *
 * The followings are the available model relations:
 * @property UserProfile $id0
 * @property UserProfile $userProfile
 */
class User extends CActiveRecord
{
	
	public $verifyCode;	
	public $pass2, $password;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'user';
	}

	public function save()
	{
		if (!is_null($this->password))
			$this->pass = sha1(md5($this->password.'You\'ll never guess'));
		return parent::save();
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, password, email, verifyCode, pass2', 'required','on'=>array('create')),
			array('user, password, email, verifyCode, pass2', 'safe'/*,'on'=>array('create','update')*/),
			array('pass2','compare','compareAttribute'=>'password'/*,'on'=>array('create','update')*/),
			array('user, email', 'unique','message'=>'{attribute} {value} has already been used!'),
			array('verified, confirmed', 'numerical', 'integerOnly'=>true),
			array('user, pass', 'length', 'max'=>80),
			array('email', 'length', 'max'=>300),
			array('status', 'length', 'max'=>5),
			array('hash', 'length', 'max'=>50),
			array('email', 'CEmailValidator'),
			array('verifyCode','captcha','on'=>'create'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user, email, status, verified, confirmed, hash, verifyCode', 'safe', 'on'=>'search'),
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
			'userProfile' => array(self::HAS_ONE, 'UserProfile', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user' => 'User',
			'password' => 'Password',
			'pass2' => 'Repeat password',
			'email' => 'Email',
			'status' => 'Status',
			'verified' => 'Verified',
			'confirmed' => 'Confirmed',
			'hash' => 'Hash',
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
		$criteria->compare('user',$this->user,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('verified',$this->verified);
		$criteria->compare('confirmed',$this->confirmed);
		//$criteria->compare('hash',$this->hash,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}