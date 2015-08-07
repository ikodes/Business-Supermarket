<?php

class PagesController extends Controller
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index','update','create','ldelete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	  public function actionCreate(){
	  
	  $listid = Yii::app()->request->getParam('id');
        $this->pageTitle='Create Pages - Business Supermarket';
        if(isset($listid) && $listid !=""){            
            $model = Pages::model()->find("id  ='".$listid."'");   
            $model->attributes=$_POST['Pages'];           
            
        }else {
            $model = new Pages; 
            $model->attributes=$_POST['Pages'];
        }
		
		
        
       if(isset($_POST['Pages']))
		   {
		   

            	$model->attributes=$_POST['Pages'];
                    $model->pslug=$_POST['controller']."/".$_POST['action'];
                if($model->save())
    			{    
    		 	
	 					//$this->redirect(Yii::app()->createUrl('admin/pages/pages'));
					

                }
            
					 
 $this->redirect(Yii::app()->createUrl('admin/pages/pages'));
 }
		
		$this->render('create',array('model'=>$model,));
 
      

    }

 
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pages']))
		{
			$model->attributes=$_POST['Pages'];
            		if($model->save())
			{
			      $this->redirect(array('pages/pages'));
			}	
            //$this->redirect(array('view','id'=>$model->drg_lid));
		}
		

	
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		
	}

	public function actionLdelete($id)
	{
		$this->loadModel($id)->delete();
		$this->redirect(Yii::app()->createUrl('admin/pages/pages'));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{ 	 

        /**
         * Listing waiting for publication 
        **/     
         $model= new Pages('search'); 
        $criteria = new CDbCriteria;
        $criteria->order = 'id desc';
        $total = Pages::model()->count($criteria);        
        
        if (isset($_REQUEST['rows'])) {
            $count = $_REQUEST['rows'];
        } else {
            $count = 20;
        }

        
        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  
        $posts = Pages::model()->findAll($criteria);
        
       $this->render('index',array('model'=>$model,
		'list'=>$posts,
		'pages' => $pages,
		'item_count'=>$total,
		'page_size' => Yii::app()->params['listPerPage'],      
        )) ;
        
        
        
	}

 
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pages('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pages']))
			$model->attributes=$_GET['Pages'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Userlisting the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pages::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
}