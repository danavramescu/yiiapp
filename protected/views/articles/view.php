<?php
/* @var $this ArticlesController */
/* @var $model Articles */

if (Yii::app()->user->getName()=='admin' OR strtolower(Yii::app()->user->getName()) === strtolower($model->author)) {
    $this->menu=array(
        array('label'=>'Update Article', 'url'=>$this->createUrl("/articles/update", array("id" => $model->id))),    
        array('label'=>'Delete Article', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),

		array('label'=>'List Articles', 'url'=>array('index')),
    );
} else {
 $this->menu=array(
	 	array('label'=>'New Article', 'url'=>array('create')),
        array('label'=>'List Articles', 'url'=>array('index')),         
    );
}
?>

<div class="row">
	<div class="col-xs-6 col-xs-offset-3">
		<h3> <?=$model->title?> </h3><br>
		<span style="float:left"> <?=$model->author ;?> </span>
		<span style="float:right"> <?=$model->publishedAt ;?> </span>	
		<br>
		<img class="img-responsive" src="<?=Articles::FOLDER_IMAGE.$model->imgUrl;?>">
		<h3> About: </h3>
		<p> <?= $model->description; ?> </p>
	</div>	
</div>

