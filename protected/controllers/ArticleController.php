<?php

class ArticleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{	
		
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','deleteComment', 'updateComment'),
				'users'=>array('@'),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Article the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Article::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Article $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='article-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionIndex() 
	{
		$search = null;
		if (isset($_GET['titlesearch'])) {
			$search=$_GET['titlesearch'];
		} 	

		$model = new Article();
		$model->title = $search;
		$model->description = $search;
		$articles = $model->search()->getData();
	
		$this->render('index', array('articles'=>$articles, 'search'=>$search));		

		
	}

	public function actionView($id) 
	{		
		$model=$this->loadModel($id);
		$user = User::model()->findByPk(Yii::app()->user->id);
			
		//COMMENT FORM (logged users only)		
		$comments= Yii::app()->db->createCommand('select * from tbl_users INNER JOIN tbl_comments ON tbl_comments.user_id = tbl_users.id WHERE tbl_comments.article_id =:article_id ORDER BY tbl_comments.publish_date DESC')->bindValue(':article_id',$model->id )->queryAll();   
		//created joined table, ordered it by comment publish date latest to oldest

		$comment = new Comment();
		$comment->article_id = $model->id;
		$comment->user_id = $user->id;

		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			if ($comment->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
			else {
				
			} 

		}
		//END FORM


		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'user' => $user,
			'comment' => $comment,
			'comments' => $comments
		));	

	}

	

	public function actionCreate() 
	{
		$model=new Article;
		$model->publishedAt = date('Y-m-d');
		$model->author = Yii::app()->user->getName();


		if(isset($_POST['Article']))
		{				
			$model->attributes=$_POST['Article'];			
			$imageUploadFile = CUploadedFile::getInstance($model, 'image');

            if($imageUploadFile !== null){ // only do if file is really uploaded
                $imageFileName = mktime().$imageUploadFile->name;
                $model->imgUrl = $imageFileName;				
            }  

			if ($model->save())
			{
                if($imageUploadFile !== null) // validate to save file
                    $imageUploadFile->saveAs(Yii::app()->basePath . "/.." . Article::FOLDER_IMAGE.$imageFileName);        
 
                $this->redirect(array('view','id'=>$model->id));
            }			
		}

		$this->render('create', array(
			'model'=>$model
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$user=User::model()->findbyPk(Yii::app()->user->id);
		if ($user->isAdmin || $user->id === $model->user_id) {

			$this->render('update', array(
				'model' => $model
			));			

			if(isset($_POST['Article'])) {
				$imageUploadFile = CUploadedFile::getInstance($model, 'image');

				if($imageUploadFile !== null){ // only do if file is really uploaded
					$imageFileName = mktime().$imageUploadFile->name;
					$model->imgUrl = $imageFileName;				
				}
				$model->attributes=$_POST['Article'];
				if($model->save())
					if($imageUploadFile !== null) // validate to save file
						$imageUploadFile->saveAs(Yii::app()->basePath . "/.." . Article::FOLDER_IMAGE.$imageFileName);        

					$this->redirect(array('view','id'=>$model->id));
			}		
		} else {
			throw new CHttpException(404, "You don't have the rights");
		}
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	public function actionDeleteComment($id)
	{		
		$user = User::model()->findByPk(Yii::app()->user->id);
		$comment = Comment::model()->findByPk($id);	

		if ($user->isAdmin || $comment->user_id === $user->id) 	{	
			if ($comment->delete()) {
				$this->redirect(array('view','id'=>$comment->article_id));
			}
		}
	}

	public function actionUpdateComment($id)
	{		
		$user = User::model()->findByPk(Yii::app()->user->id);
		$comment = Comment::model()->findByPk($id);	
		
		if ($user->isAdmin || $comment->user_id === $user->id) 	{							
			$this->render('/comments/update', array('id'=>$comment->id));						
			if (isset($_POST['Comment'])) {
			 	$comment->attributes=$_POST['Comment'];
				if ($comment->save($id)) 					
			 		$this->redirect(array('view', 'id'=>$comment->article_id));	
			}	
		} else {
			throw new CHttpException(404, "You don't have the rights");
		}

		
	}
	
}


		