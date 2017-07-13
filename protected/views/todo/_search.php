<?php
/* @var $this TodoController */
/* @var $model Todo */
/* @var $form CActiveForm */
?>
<?php if ($model->complete === 1 AND $model->complete !== NULL) {
	$model->complete = "completed";
} elseif ($model->complete === 0 AND $model->complete !==NULL) {
	$model->complete = "in progress";
} else $model->complete = ""


?>
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'complete'); ?>
		<?php echo $form->textField($model,'complete'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->