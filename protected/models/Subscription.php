<?php

/**
 * This is the model class for table "subscription".
 *
 * The followings are the available columns in table 'subscription':
 * @property integer $id
 * @property integer $client_id
 * @property integer $subscription_id
 * @property double $amount
 * @property string $date_open
 * @property string $date_close
 */
class Subscription extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Subscription the static model class
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
		return 'subscription';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_id, subscription_id, amount, date_open', 'required'),
			array('client_id, subscription_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('date_close', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, client_id, subscription_id, amount, date_open, date_close', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'client_id' => 'Client',
			'subscription_id' => 'Subscription',
			'amount' => 'Amount',
			'date_open' => 'Date Open',
			'date_close' => 'Date Close',
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
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('subscription_id',$this->subscription_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('date_open',$this->date_open,true);
		$criteria->compare('date_close',$this->date_close,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}