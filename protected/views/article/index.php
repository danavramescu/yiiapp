<?php

 $this->menu=array(
		array('label'=>'New Article', 'url'=>array('create')),
		array('label'=>'List Articles', 'url'=>array('index')),                       
    );

?>

<h3> List of Articles </h3>
<form method="get">
	<input type="search" name="titlesearch" value="<?=$search?>">
	<input type="submit" for="titlesearch">
</form>
<div class="row">
	<?php foreach ($articles as $article)  : ?>	
	<div class="col-xs-4">	
		<a href="/article/view?id=<?=$article->id ?>">
			<h3 style="height:50px;"> <?=$article['title']?> </h3>
			<span style="float:left"> <?=$article->author ;?> </span>
			<span style="float:right"> <?=$article->publishedAt ;?> </span>				
			<br>
			<div style="min-height:150px; max-height:150px; overflow:hidden; display:block; background-color:black; background-image:url(<?=Article::FOLDER_IMAGE.$article->imgUrl;?>); background-size:contain; background-repeat:no-repeat; background-position:center center;"></div>
			<p style="height:50px"> <?=$article->description; ?> </p>
		</a>
	</div>
	<?php endforeach; ?>
</div>

