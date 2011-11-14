<?php

/**
 * This is the model class for table "payment_methods".
 *
 * The followings are the available columns in table 'payment_methods':
 * @property integer $id
 * @property string $code
 * @property string $payment_page
 * @property string $landing_page
 * @property integer $deposit_active
 * @property integer $withdraw_active
 * @property integer $deposit_fee
 * @property integer $withdraw_fee
 */
class PaymentMethods extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PaymentMethods the static model class
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
		return 'payment_methods';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, deposit_active, withdraw_active, deposit_fee, withdraw_fee', 'required'),
			array('deposit_active, withdraw_active, deposit_fee, withdraw_fee', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, deposit_active, withdraw_active, deposit_fee, withdraw_fee', 'safe', 'on'=>'search'),
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
			'code' => 'Code',
			'deposit_active' => 'Deposit Active',
			'withdraw_active' => 'Withdraw Active',
			'deposit_fee' => 'Deposit Fee',
			'withdraw_fee' => 'Withdraw Fee',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('deposit_active',$this->deposit_active);
		$criteria->compare('withdraw_active',$this->withdraw_active);
		$criteria->compare('deposit_fee',$this->deposit_fee);
		$criteria->compare('withdraw_fee',$this->withdraw_fee);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}