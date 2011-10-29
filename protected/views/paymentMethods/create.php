<?php
$this->breadcrumbs=array(
	'Payment Methods'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PaymentMethods', 'url'=>array('index')),
	array('label'=>'Manage PaymentMethods', 'url'=>array('admin')),
);
?>

<h1>Create PaymentMethods</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>