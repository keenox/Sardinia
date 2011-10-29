<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payment-methods-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_page'); ?>
		<?php echo $form->textField($model,'payment_page',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'payment_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'landing_page'); ?>
		<?php echo $form->textField($model,'landing_page',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'landing_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deposit_active'); ?>
		<?php echo $form->textField($model,'deposit_active'); ?>
		<?php echo $form->error($model,'deposit_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'withdraw_active'); ?>
		<?php echo $form->textField($model,'withdraw_active'); ?>
		<?php echo $form->error($model,'withdraw_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deposit_fee'); ?>
		<?php echo $form->textField($model,'deposit_fee'); ?>
		<?php echo $form->error($model,'deposit_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'withdraw_fee'); ?>
		<?php echo $form->textField($model,'withdraw_fee'); ?>
		<?php echo $form->error($model,'withdraw_fee'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->