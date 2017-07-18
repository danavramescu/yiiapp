<?php
/* @var $this ArticlesController */
/* @var $model Articles */
/* @var $comment Comments */
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
		<?php echo $form->textArea($comment,'content',array('rows'=>3, 'cols'=>85, 'maxlength'=>400, 'value'=>'' , 'placeholder'=>'Write your message here...')); ?>
		<?php echo $form->error($comment,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($comment->isNewRecord ? 'Create' : 'Post Message'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->