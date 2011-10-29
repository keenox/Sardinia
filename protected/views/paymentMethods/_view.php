<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_page')); ?>:</b>
	<?php echo CHtml::encode($data->payment_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('landing_page')); ?>:</b>
	<?php echo CHtml::encode($data->landing_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deposit_active')); ?>:</b>
	<?php echo CHtml::encode($data->deposit_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('withdraw_active')); ?>:</b>
	<?php echo CHtml::encode($data->withdraw_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deposit_fee')); ?>:</b>
	<?php echo CHtml::encode($data->deposit_fee); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('withdraw_fee')); ?>:</b>
	<?php echo CHtml::encode($data->withdraw_fee); ?>
	<br />

	*/ ?>

</div>