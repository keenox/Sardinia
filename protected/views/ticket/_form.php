<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->textArea($model,'message',array('maxlength' => 500, 'rows' => 8, 'cols' => 50)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<?php
	if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<br />
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<br />
		<?php echo $form->textField($model,'verifyCode'); ?>
		<br />
		</div>
		<div class="hint">Enter the characters above.
		<br/>Caps don't matter.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif;?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->