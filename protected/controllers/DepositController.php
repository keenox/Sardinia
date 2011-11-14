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
                            if (!Yii::app()->user->isGuest){
				$payment_method = PaymentMethods::model()->find('id='.$model->payment_method);
                                $model->amount = $model->credits + ($model->credits * $payment_method->deposit_fee)/100;
				$model->client_id = Yii::app()->user->id;
				$model->order_placed = new CDbExpression('NOW()');
				$model->order_modified = new CDbExpression('NOW()');
				$model->client_ip = $_SERVER['REMOTE_ADDR'];
				$model->status = '0'; // 0 - PENDING, 1 - FAILED, 2 - SUCCESS
				$model->insert();
				
				$criteria = new CDbCriteria;
				$criteria->condition='client_id = '.Yii::app()->user->id;
				$criteria->limit=1;
				$criteria->order='id DESC';
				$lastdeposit = Deposits::model()->find($criteria);
				header('Location: '.$this->createUrl('pay', array("deposit_id"=>$lastdeposit->id)));
				return;
                            } else {
                                //TODO: redirect to login!!
                            }
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
		if(isset($_GET['deposit_id'])){
			// this method is to show a single deposit

			// getting the deposit details, making sure that the client is the owner of the deposit
			$deposit = Deposits::model()->findByAttributes(array('id'=>(int)$_GET['deposit_id'], 'client_id'=>Yii::app()->user->id));

			if(!$deposit){
				// if the deposit does not exist, redirect to main deposits page
				header('Location: '.$this->createUrl('pay'));
				exit();
			}

                        // find out if we need to flash the user with any payment success/fail message
                        $flash_message = null;
                        if(isset($_GET['payment'])){
                            $flash_message = ($_GET['payment']=="success")?"1":"0";
                        }
			
			$payment_method = PaymentMethods::model()->findByAttributes(array('id'=>$deposit->payment_method));
			$this->render('pay_single', array('payment_method'=>$payment_method, 'deposit'=>$deposit, 'flash_message'=>$flash_message));
		} else {
			// show all deposits
			$this->render('pay');
		}
	}

        public function actionLr()
	{
            if(isset($_GET['status']) && isset($_POST['deposit_id'])){
                $status = $_GET['status'];
                $deposit_id = $_POST['deposit_id'];
                if($status == (int)0 || $status == (int)1){
                    // status variable is valid
                    if(is_numeric($deposit_id)){
                        // if the deposit is NUMERIC and if it's a valid deposit ID, proceed
                        $deposit = Deposits::model()->findByAttributes(array('id'=>(int)$deposit_id, 'client_id'=>(int)Yii::app()->user->id, ));
                        if($deposit!=null){
                            if($status == 0){
                                // PAYMENT FAILED
                                $deposit->status = 1;
                                $deposit->order_modified = new CDbExpression('NOW()');
                                $deposit->save();
                                // render payment failed
                                $payment_status_text = "failed";
                            } else if($status == 1){
                                // CHECK WITH LR API IF THE PAYMENT HAS ARRIVED
                                include_once(getcwd()."/../lrapi/XMLApiAgent.php");
                                $receiptId = $_POST['lr_transfer'];
                                $auth = new Authentication("U7074533", "testing", "nero123456");
                                $findTransfer = findTransaction($auth, $receiptId );
                                if(
                                    //$findTransfer->Amount == $deposit->amount &&
                                    $findTransfer->Amount == "0.01" &&
                                    $findTransfer->Currency == "lrusd" &&
                                    $findTransfer->Payee == "U7074533"
                                ){
                                    // PAYMENT SUCCESS
                                    //
                                    // MOVE CREDITS INTO ACCOUNT
                                    $userp = UserProfile::model()->findByAttributes(array('id'=>(int)Yii::app()->user->id));
                                    $userp->ewallet += $deposit->credits;
                                    $userp->save();
                                    // GIVE REFERRAL BONUS
                                    $referrer = UserProfile::model()->findByAttributes(array('id'=>(int)$userp->ref_id));
                                    if($referrer != null){
                                        $referrer->ewallet += ($deposit->credits * 10 / 100);
                                        $referrer->save();
                                        //TODO: save in bonus payments !!!!!!
                                    }
                                    // UPDATE DEPOSIT STATUS
                                    $deposit->status = 2;
                                    $deposit->order_modified = new CDbExpression('NOW()');
                                    $additional_info = array("lr_ref"=>$receiptId, "payer"=>$findTransfer->Payer);
                                    $deposit->additional_info = json_encode($additional_info);
                                    $deposit->save();
                                    // REDIRECT TO PAYMENT SUCCESS
                                    $payment_status_text = "success";
                                  }
                            }
                            header('Location: '.$this->createUrl('pay', array("deposit_id"=>$deposit->id, 'payment'=>$payment_status_text)));
                        } else {
                            // if the deposit does not exist, redirect to deposits main page
                            header('Location: '.$this->createUrl('pay'));
                        }
                    } else {
                        // if the deposit is not numeric, redirect to deposits main page
                        header('Location: '.$this->createUrl('pay'));
                    }
                } else {
                    // if the status variable is not 0 or 1, redirect to deposits main page
                    header('Location: '.$this->createUrl('pay'));
                }
            } else {
            // if the status variable is not sent in the URL, redirect to deposits main page
            header('Location: '.$this->createUrl('pay'));
            }
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