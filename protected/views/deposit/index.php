<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deposits-index-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'credits'); ?>
		<?php echo $form->textField($model,'credits'); ?>
		<?php echo $form->error($model,'credits'); ?>
	</div>

	<div class="row">
		<?php echo "<b>Choose a payment method:</b>"; ?>
        <?php echo $form->error($model,'payment_method'); ?>
    </div>
    
    <div class="row">&nbsp;</div>
    
    <div class="row">
        <?php
		// PLEASE REMOVE THE FOLLOWING FUNCTION WHEN TRANSLATING!!!
		function translate($arg){
			$val="";
			switch($arg){
				case 'lr': $val = "Liberty Reserve"; break;
				case 'wbt': $val = "Wire Bank Transfer"; break;
			}
			return $val;
		}
		// Preparing the Payment Methods drop down box
		$drop_down_array = array();
		foreach(CHtml::listData(PaymentMethods::model()->findAll('deposit_active = 1'), 'id', 'code') as $key => $val){
			//echo "<b>$key</b> - $val<br>"; // THIS IS FOR TESTING PURPOSES ONLY
			$drop_down_array[$key] = translate($val); 
		}
		?>
		<?php echo $form->dropDownList($model,'payment_method', $drop_down_array); /*$form->radioButtonList($model,'payment_method', $drop_down_array);*/ ?>
	</div>
    
    <div class="row">&nbsp;</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Continue >'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->