<?php
/* @var $this ArticlesController */
/* @var $model Articles */
if (Yii::app()->user->getName()=='admin') {
    $this->menu=array(
        array('label'=>'List Articles', 'url'=>array('index')),
    );
} else {
    $this->menu=array(
        array('label'=>'List Articles', 'url'=>array('index')),
    );
}
?>

<h1>Create Articles</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>