<?php
/* @var $this TodoController */
/* @var $data Todo */
?>
<?php if ($data->complete == 1) {
	$data->complete = "completed";
}  else {
	$data->complete = "in progress";
}
?>
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('complete')); ?>:</b>
	<?php echo CHtml::encode($data->complete); ?>
	<br />


</div>