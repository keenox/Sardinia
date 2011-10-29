<?php
$this->breadcrumbs=array(
	'Payment Methods'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PaymentMethods', 'url'=>array('index')),
	array('label'=>'Create PaymentMethods', 'url'=>array('create')),
	array('label'=>'View PaymentMethods', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PaymentMethods', 'url'=>array('admin')),
);
?>

<h1>Update PaymentMethods <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>