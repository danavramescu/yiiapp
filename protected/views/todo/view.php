<?php
/* @var $this TodoController */
/* @var $model Todo */

$this->breadcrumbs=array(
	'Todos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Todo', 'url'=>array('index'), 'class'=>'classname'),
	array('label'=>'Create Todo', 'url'=>array('create')),
	array('label'=>'Update Todo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Todo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	
);

if ($model->complete == 1) {
	$model->complete = "completed";
}  else {
	$model->complete = "in progress";
}

?>

<h1>View Todo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'complete',
	),
)); ?>
