<?php
$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Ticket', 'url'=>array('index')),
	array('label'=>'Create Ticket', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ticket-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tickets</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ticket-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		array(
				'header'=>'Assigned to',
				'name'=>'admin_id',
				'filter'=>CHtml::activeDropDownList($model,'admin_id',
										array(null=>'All',0=>'noone') + 
										((Yii::app()->user->type=='admin')?array(Yii::app()->user->id=>'Me'):array()) +
										CHtml::listData(Ticket::model()->findAll(),'admin_id','admin_id')
										),
		),
		'subject',
		'created',
		'status',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{delete}{assign}',
			'buttons'=>array(
								'assign'=>array(
											'label'=>'Assign',
											'imageUrl'=>Yii::app()->baseUrl.'/images/hand_property.png',
											'url'=>'Yii::app()->createUrl(\'ticket/assign\',array(\'id\'=>$data->id))',
											'visible'=>'Yii::app()->user->type==\'admin\' && $data->admin_id===null',
											),
							),
		),
	),
)); ?>
