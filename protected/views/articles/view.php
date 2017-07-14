<?php
/* @var $this ArticlesController */
/* @var $model Articles */
$result = $user->isAdmin(); 

if ($result OR strtolower(Yii::app()->user->getName()) === strtolower($model->author)) {
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

<div class="row">
	<div class="col-xs-12">
		<h3> Comment Section </h3>
		<p> You can leave your comments on this article below  </p>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<?php $this->renderPartial('/comments/_form', array('model'=>$model)); ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-3">
		<span> <?=$user->username;?> </span>
	</div>
	<div class="col-xs-9">
		<div style="background-color:#f2f2f2; width:100%;">
			blana
		</div>
	</div>
</div>

