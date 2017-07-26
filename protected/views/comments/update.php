<?php
/* @var $this CommentsController */
/* @var $model Comments */
$comment = Comment::model()->findByPk($id);
$this->menu=array(
	array('label'=>'List Articles', 'url'=>array('index')),
	
);
?>

<h1>Update Comments <?php echo $comment->id; ?></h1>

<?php $this->renderPartial('/comments/_formUpdate', array('model'=>$comment)); ?>