<?php
/* @var $this ArticlesController */
/* @var $model Comments */ 

$comment = $model;
$content = $comment['content'];
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>	

	<?php echo $form->errorSummary($comment); ?>

	<div class="row">		
		<?php echo $form->textArea($comment,'content',array('rows'=>3, 'cols'=>85, 'maxlength'=>400, 'value'=>'' , 'placeholder'=>$content)); ?>
		<?php echo $form->error($comment,'content'); ?>
	</div>

	<div class="row buttons">
		<input type="submit" class="btn btn-success" value="Save Changes" style="margin:0;">
		<a type="button" class="btn btn-warning" href='/article/view?id=<?=$comment['article_id']?>'>Back </a>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->