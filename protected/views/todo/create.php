<?php
/* @var $this TodoController */
/* @var $model Todo */

$this->breadcrumbs=array(
	'Todos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Todo', 'url'=>array('index')),
	
);
?>

<h1>Create Todo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>