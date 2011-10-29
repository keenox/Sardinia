<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<?php echo $form->errorSummary($profile); ?>

	<div class="row">
		<?php echo $form->labelEx($profile,'country'); ?>
		<?php echo $form->dropDownList($profile,'country',
										CHtml::listData(Country::model()->findAll(),'iso','printable_name')
										);
			?>
		<?php echo $form->error($profile,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($profile,'postcode'); ?>
		<?php echo $form->textField($profile,'postcode'); ?>
		<?php echo $form->error($profile,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($profile,'state'); ?>
		<?php echo $form->textField($profile,'state',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($profile,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($profile,'address'); ?>
		<?php echo $form->textField($profile,'address',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($profile,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($profile,'phone'); ?>
		<?php echo $form->textField($profile,'phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($profile,'phone'); ?>
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