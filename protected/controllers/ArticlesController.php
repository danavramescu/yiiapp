<?php

class ArticlesController extends Controller
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
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
	 * @return Articles the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Articles::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Articles $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='articles-form')
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

		$model = new Articles();
		$model->title = $search;
		$model->description = $search;
		$articles = $model->search()->getData();

		//$articles = Articles::model()->findAllByAttributes(array('title'=>$search));		
		//$articles = Articles::model()->findAll();
		
		
		
		$this->render('index', array('articles'=>$articles, 'search'=>$search));		

		
	}

##	public function actionIndex() {
##		$articles =new Articles('search');
##		if(isset($_GET['Articles']))
##			$articles->attributes =$_GET['Articles'];
##
##		$this->render('index', array('articles'=>$articles));
##	}

	public function actionView($id) 
	{				
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));		
	}

	public function actionCreate() 
	{
		$model=new Articles;
		$model->publishedAt = date('Y-m-d');
		$model->author = Yii::app()->user->getName();

		/*
		next block saves the newly posted article 
		*/

		if(isset($_POST['Articles']))
		{				
			$model->attributes=$_POST['Articles'];			
			$imageUploadFile = CUploadedFile::getInstance($model, 'image');

            if($imageUploadFile !== null){ // only do if file is really uploaded
                $imageFileName = mktime().$imageUploadFile->name;
                $model->imgUrl = $imageFileName;				
            }  

			if ($model->save())
			{
                if($imageUploadFile !== null) // validate to save file
                    $imageUploadFile->saveAs(Yii::app()->basePath . "/.." . Articles::FOLDER_IMAGE.$imageFileName);        
 
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
		if(isset($_POST['Articles'])) {

			$imageUploadFile = CUploadedFile::getInstance($model, 'image');

			if($imageUploadFile !== null){ // only do if file is really uploaded
				$imageFileName = mktime().$imageUploadFile->name;
				$model->imgUrl = $imageFileName;				
			}  

			if ($model->save())
			{
				if($imageUploadFile !== null) // validate to save file
					$imageUploadFile->saveAs(Yii::app()->basePath . "/.." . Articles::FOLDER_IMAGE.$imageFileName);        

				$this->redirect(array('index','id'=>$model->id));
			}
		}
		$this->render('update', array(
			'model' => $model
		));
		

			if(isset($_POST['Articles']))
		{
			$model->attributes=$_POST['Articles'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}		
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	
}
