<?php
/* @var $this TodoController */
/* @var $model Todo */

$this->breadcrumbs=array(
	'Todos'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Todo', 'url'=>array('index')),
	//array('label'=>'Create Todo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#todo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");


?>
<h3 style="padding-left:10px;"> Add a new ToDo Task </h3>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'todo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'description',
		array (
			'name' => 'complete',
			'value'=> function($data) {
				if ($data->complete) 
					return 'complete';
				else
					return 'in progress';
			}
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

