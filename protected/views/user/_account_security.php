<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pass2'); ?>
		<?php echo $form->passwordField($model,'pass2',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'pass2'); ?>
	</div>

	<?php echo $form->errorSummary($profile); ?>

	<div class="row">
		<?php echo $form->labelEx($profile,'security'); ?>
		<?php echo $form->textField($profile,'security',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($profile,'security'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($profile,'answer'); ?>
		<?php echo $form->textField($profile,'answer',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($profile,'answer'); ?>
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