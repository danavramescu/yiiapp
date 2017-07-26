<?php
/* @var $this ArticlesController */
/* @var $model Articles */

?>

<h1>Update Article <?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>