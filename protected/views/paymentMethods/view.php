<?php
$this->breadcrumbs=array(
	'Payment Methods'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PaymentMethods', 'url'=>array('index')),
	array('label'=>'Create PaymentMethods', 'url'=>array('create')),
	array('label'=>'Update PaymentMethods', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PaymentMethods', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PaymentMethods', 'url'=>array('admin')),
);
?>

<h1>View PaymentMethods #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'payment_page',
		'landing_page',
		'deposit_active',
		'withdraw_active',
		'deposit_fee',
		'withdraw_fee',
	),
)); ?>
