<?php
/* @var $this TodoController */
/* @var $model Todo */
/* @var $form CActiveForm */


?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'todo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="col-xs-3">			
			<?php echo $form->labelEx($model,'title'); ?>
			<?php echo $form->textField($model,'title',array('size'=>20,'maxlength'=>25)); ?>
			<?php echo $form->error($model,'title'); ?>			
		</div>
		<div class="col-xs-7">			
			<?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'description'); ?>			
		</div>
		<div class="col-xs-2">
			<?php echo $form->labelEx($model,'complete'); ?>
			<?php echo $form->checkbox($model,'complete'); ?>
			<?php echo $form->error($model,'complete'); ?>
		</div>
	</div>
	<div class="row buttons">
		<div class="col-xs-12">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->