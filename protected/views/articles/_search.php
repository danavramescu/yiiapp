<?php
/* @var $this ArticlesController */
/* @var $model Articles */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $searchform=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<div class="col-xs-9">			
			<?php echo $searchform->textField($model, 'title'); ?>
		</div>
		<div class="col-xs-3">
			<?php echo CHtml::submitButton('Search'); ?>
		</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->