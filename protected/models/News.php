<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $content
 * @property string $date
 * @property integer $visits
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return News the static model class
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
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, title, content, date, visits', 'required'),
			array('visits', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>20),
			array('title', 'length', 'max'=>80),
			array('content', 'length', 'max'=>8000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, title, content, date, visits', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'title' => 'Title',
			'content' => 'Content',
			'date' => 'Date',
			'visits' => 'Visits',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('visits',$this->visits);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}