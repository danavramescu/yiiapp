<?php
/* @var $this ArticleController */
/* @var $model Article */

if (!Yii::app()->user->isGuest) 
	$result = $user->isAdmin(); 



if (!Yii::app()->user->isGuest) {
	if ($result OR strtolower(Yii::app()->user->getName()) === strtolower($model->author)) {
		$this->menu=array(
			array('label'=>'Update Article', 'url'=>$this->createUrl("/article/update", array("id" => $model->id))),    
			array('label'=>'Delete Article', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
			array('label'=>'List Articles', 'url'=>array('index')),
		);

	} else {
	$this->menu=array(
			array('label'=>'New Article', 'url'=>array('create')),
			array('label'=>'List Articles', 'url'=>array('index')),         
		);
	}
}
?>

<div class="row">
	<div class="col-xs-6 col-xs-offset-3">
		<h3> <?=$model->title?> </h3><br>
		<span style="float:left"> <?=$model->author ;?> </span>
		<span style="float:right"> <?=$model->publishedAt ;?> </span>	
		<br>
		<img class="img-responsive" src="<?=Article::FOLDER_IMAGE.$model->imgUrl;?>">
		<h3> About: </h3>
		<p> <?= $model->description;  ?> </p>
	</div>	
</div>

<div class="row">
	<div class="col-xs-12">
		<h3> Comment Section </h3>
		<p> You can leave your comments on this article below  </p>
	</div>
</div>

<br>
<?php if (!Yii::app()->user->isGuest) : ?>
<div class="row">
	<div class="col-xs-12">
		<?php $this->renderPartial('/comments/_form', array('comment' => $comment, 'model'=>$model)); ?>
	</div>
</div>
<?php endif; ?>
<br>
<?php if (!empty($comments))
		foreach ($comments as $item) :?>

<?php 
$ownerStyle='';
if($user['username'] === $item['username']) 
	$ownerStyle= 'filter:invert(100%)'; ?>

<div class="row" style = "margin-top:5px;">	
	<div class="col-xs-2">
		<span style="padding:10px 20px; display:block; background:darkgray;  <?=$ownerStyle?>"><?php echo $item['username']; ?></span>
	</div>	
	<div class="col-xs-8">
		<div style="background-color:#f2f2f2; width:100%;  padding:10px 20px;  <?=$ownerStyle?>">			
			<?php echo $item['content'];?>
		</div>
	</div>
	<?php if($user->isAdmin || $user['username'] === $item['username']) : ?>
	<div class="col-xs-2">
		<div class="row">
			<div class="col-xs-6">				
				<form action="/article/deleteComment?id=<?=$item['id']?>" method="post">
					<input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this comment?')" class="btn btn-danger btn-sm" style="height:40px;">
				</form>
			</div>
			<div class="col-xs-6">
				<form action="/article/updateComment?id=<?=$item['id']?>" method="post" >
					<input type="submit" value="Edit" class="btn btn-sm btn-success" style="height:40px;">
				</form>
			</div>				
		</div>
	</div>
	<?php endif; ?>
</div>
<?php endforeach;?>
