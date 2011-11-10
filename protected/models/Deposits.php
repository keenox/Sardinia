<?php

/**
 * This is the model class for table "deposits".
 *
 * The followings are the available columns in table 'deposits':
 * @property integer $id
 * @property double $amount
 * @property integer $client_id
 * @property string $order_placed
 * @property string $order_modified
 * @property integer $payment_method
 * @property string $status
 * @property string $client_ip
 *
 * The followings are the available model relations:
 * @property User $client
 */
class Deposits extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Deposits the static model class
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
		return 'deposits';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('credits, payment_method', 'required'),
			array('credits', 'numerical', 'min'=>500),
			array('credits', 'numerical', 'max'=>500000),
			array('credits, payment_method', 'safe'),
			array('payment_method', 'exist', 'className'=>'PaymentMethods', 'attributeName' => 'id'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, credits, amount, client_id, order_placed, order_modified, payment_method, status, additional_info, client_ip', 'safe', 'on'=>'search'),
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
			'client' => array(self::BELONGS_TO, 'User', 'client_id'),
			//'groups' => array(self::MANY_MANY,'Group','tbl_usergroup(personId,groupId)',
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'amount' => 'Amount',
                        'credits' => 'Credits',
			'client_id' => 'Client',
			'order_placed' => 'Order Placed',
			'order_modified' => 'Order Modified',
			'payment_method' => 'Payment Method',
			'status' => 'Status',
                        'additional_info' => 'Additional Info',
			'client_ip' => 'Client Ip',
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
		$criteria->compare('amount',$this->amount);
                $criteria->compare('credits',$this->amount);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('order_placed',$this->order_placed,true);
		$criteria->compare('order_modified',$this->order_modified,true);
		$criteria->compare('payment_method',$this->payment_method);
		$criteria->compare('status',$this->status,true);
                $criteria->compare('additional_info',$this->additional_info,true);
		$criteria->compare('client_ip',$this->client_ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}