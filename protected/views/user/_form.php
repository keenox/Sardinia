<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user'); ?>
		<?php echo $form->textField($model,'user',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'user'); ?>
	</div>

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

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<?php echo $form->errorSummary($profile); ?>

	<div class="row">
		<?php echo $form->labelEx($profile,'fname'); ?>
		<?php echo $form->textField($profile,'fname',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($profile,'fname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($profile,'lname'); ?>
		<?php echo $form->textField($profile,'lname',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($profile,'lname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($profile,'gender'); ?>
		<?php echo $form->dropDownList($profile,'gender',array('m'=>'Male','f'=>'Female')); ?>
		<?php echo $form->error($profile,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($profile,'ref_id'); ?>
		<?php echo $form->textField($profile,'ref_id'); ?>
		<?php echo $form->error($profile,'ref_id'); ?>
	</div>

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

	<div class="row">
		<?php echo $form->labelEx($profile,'date_of_birth'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
								    'model'=>$profile,
									'attribute'=>'date_of_birth',
								    // additional javascript options for the date picker plugin
								    'options'=>array(
								        'showAnim'=>'fold',
										'showOn'=>'both',
										'buttonImageOnly'=>'true',
										'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
										'dateFormat'=>'yy-mm-dd',
										'yearRange'=>'c-90:c-18',
										'yearRange'=>'c-90:c-18',
										'changeYear'=>'true',		
								    ),
								    'htmlOptions'=>array(
								        'style'=>'height:20px;'
								    ),
								));?>
		<?php echo $form->error($profile,'date_of_birth'); ?>
	</div>

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