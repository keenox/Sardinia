<?php
$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserProfile', 'url'=>array('index')),
	array('label'=>'Manage UserProfile', 'url'=>array('admin')),
);
?>

<h1>Create UserProfile</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>