<?php

class DepositController extends Controller
{
	public function actionIndex()
	{
		$model=new Deposits;
		if(isset($_POST['Deposits']))
		{
			$model->attributes=$_POST['Deposits'];
			if($model->validate())
			{
				$user = User::model()->findByAttributes(array('user'=>Yii::app()->user->name));
				$payment_method = PaymentMethods::model()->find('id='.$model->payment_method);
				$model->client_id = $user->id;
				$model->order_placed = new CDbExpression('NOW()');
				$model->order_modified = new CDbExpression('NOW()');
				$model->client_ip = $_SERVER['REMOTE_ADDR'];
				$model->status = '0'; // 0 MEANS PENDING
				$model->insert();
				
				$criteria = new CDbCriteria;
				$criteria->condition='client_id = '.$user->id;
				$criteria->limit=1;
				$criteria->order='id DESC';
				
				$lastdeposit = Deposits::model()->find($criteria);
				$this->actionPay($lastdeposit->id);
				//print_r($model->attributes);
				// form inputs are valid, do something here
				return;
			}
		}
		$this->render('index',array('model'=>$model));
	}

	public function actionProcessing()
	{
		
		$this->render('processing');
	}
	
	public function actionPay()
	{
		if(isset($_GET['deposit_id']) || isset($deposit_id)){
			// show single deposit
			$this->render('processing');
		} else {
			// show all deposits
			$this->render('result');
		}
	}

	public function actionResult()
	{
		$this->render('result');
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}