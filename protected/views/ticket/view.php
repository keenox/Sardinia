<?php
$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Ticket', 'url'=>array('index')),
	array('label'=>'Create Ticket', 'url'=>array('create')),
	array('label'=>'Update Ticket', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Ticket', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ticket', 'url'=>array('admin')),
);
?>

<em>Ticket #<?php echo $model->id; ?></em>
<h2><?php echo $model->subject; ?></h2>
<span>Created: <?php echo $model->created;?></span>&nbsp;<span>Assigned admin: <?php echo $model->admin;?></span>

<?php 
	$messages = TicketMessage::model()->with(array('ticket'=>array('condition'=>'ticket_id='.$model->id)))->findAll();
	
	for ($i=0;$i<sizeof($messages);$i++)
	{
		?>
		<div style="border:1px solid #000; padding-bottom:5px; margin-bottom:10px;">
			<div style="background-color:#ddd;font-weight:bold;width:100%;">
				Posted by <?php echo $messages[$i]->user_id; ?> at <?php echo $messages[$i]->created; ?> from IP <?php echo $messages[$i]->ip; ?>  
			</div>
			<div style="padding:5px;" >
				<?php echo $messages[$i]->message; ?>
			</div>
		</div>
		<?php		
	}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($newMessage); ?>

	<div class="row">
		<?php echo $form->textArea($newMessage,'message',array('maxlength' => 500, 'rows' => 8, 'cols' => 50)); ?>
		<?php echo $form->error($newMessage,'message'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Post'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->