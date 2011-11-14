<?php

/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property integer $id
 * @property integer $user_id
 * @property integer $admin_id
 * @property string $subject
 * @property string $created
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Administrator $admin
 * @property User $user
 * @property TicketMessage[] $ticketMessages
 */
class Ticket extends CActiveRecord
{
	public $message;	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Ticket the static model class
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
		return 'ticket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, created, message', 'required'),
			array('user_id, admin_id', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>30),
			array('status', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, admin_id, subject, created, status', 'safe', 'on'=>'search'),
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
			'admin' => array(self::BELONGS_TO, 'Administrator', 'admin_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'ticketMessages' => array(self::HAS_MANY, 'TicketMessage', 'ticket_id'),
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
			'admin_id' => 'Admin',
			'subject' => 'Subject',
			'created' => 'Created',
			'status' => 'Status',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}