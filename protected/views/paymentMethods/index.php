<?php
$this->breadcrumbs=array(
	'Payment Methods',
);

$this->menu=array(
	array('label'=>'Create PaymentMethods', 'url'=>array('create')),
	array('label'=>'Manage PaymentMethods', 'url'=>array('admin')),
);
?>

<h1>Payment Methods</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
