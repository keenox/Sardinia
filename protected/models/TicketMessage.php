<?php

/**
 * This is the model class for table "ticket_message".
 *
 * The followings are the available columns in table 'ticket_message':
 * @property integer $id
 * @property integer $ticket_id
 * @property integer $user_id
 * @property integer $admin_id
 * @property string $message
 * @property string $created
 * @property string $ip
 *
 * The followings are the available model relations:
 * @property Administrator $admin
 * @property Ticket $ticket
 * @property User $user
 */
class TicketMessage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TicketMessage the static model class
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
		return 'ticket_message';
	}

	public function save()
	{
		if ($this->isNewRecord)
			$this->message = nl2br(htmlentities($this->message));
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
			array('ticket_id, message, created, ip', 'required'),
			array('ticket_id, user_id, admin_id', 'numerical', 'integerOnly'=>true),
			array('message', 'length', 'max'=>500),
			array('ip', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ticket_id, user_id, admin_id, message, created, ip', 'safe', 'on'=>'search'),
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
			'ticket' => array(self::BELONGS_TO, 'Ticket', 'ticket_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ticket_id' => 'Ticket',
			'user_id' => 'User',
			'admin_id' => 'Admin',
			'message' => 'Message',
			'created' => 'Created',
			'ip' => 'Ip',
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
		$criteria->compare('ticket_id',$this->ticket_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}