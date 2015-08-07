<?php

class PrizeController extends Controller
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
				'actions'=>array('admin','delete','index','update','ldelete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	
	}

	public function actionIndex()
	{ 	 
$month=date('m');
$year=date('Y');

        $criteria = new CDbCriteria;
        $criteria->order = 'id desc';
		$criteria->compare('year',$year,true);
		$criteria->compare('month',$month,true);

		$count=Prize::model()->count();
		if($count=="0")
		{
		
		$Prize = new Prize;
                     $Prize->month = $month;
                     $Prize->year = $year;
                     $Prize->save();
		}     
else if(isset($_POST['savedraw'])){
$year=$_REQUEST['year'];
$prizeid=$_REQUEST['prizeid'];
$month=$_REQUEST['month'];
$prize_value=$_REQUEST['prize_values'];
$points_required=$_REQUEST['points_required'];
$connection = Yii::app()->db;
$command = $connection->createCommand("update `drg_price_draw` set prize_value='$prize_value',points_required='$points_required' where `id`='$prizeid'");
$myresult = $command->execute();
}
else if(isset($_POST['winner_gallery']))
{

$PrizeDrawWinners = new PrizeDrawWinners;
                     $PrizeDrawWinners->user_id = $_POST['win_username'];
                     $PrizeDrawWinners->date_draw = $_POST['draw_date'];
$PrizeDrawWinners->amount_paid_date = $_POST['draw_date'];
                     $PrizeDrawWinners->prize_won_amount =  $_POST['amount_won'];
                     $PrizeDrawWinners->payment_ref =  $_POST['payment_ref'];
                     $PrizeDrawWinners->save();
}

  


 $model= new PrizeDrawWinners('search'); 
        $criteria = new CDbCriteria;
        $criteria->order = 'id desc';
        $total = PrizeDrawWinners::model()->count($criteria);        
        
        if (isset($_REQUEST['rows'])) {
            $count = $_REQUEST['rows'];
        } else {
            $count = 20;
        }

        
        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  
        $posts = PrizeDrawWinners::model()->findAll($criteria);
        
       $this->render('index',array('model'=>$model,
		'list'=>$posts,
		'pages' => $pages,
		'item_count'=>$total,
		'page_size' => Yii::app()->params['listPerPage'],      
        )) ;
        
        
   

}

public function actionLdelete($id)
	{
		PrizeDrawWinners::model()->deleteAll("id ='" .$id. "'");
		$this->redirect(Yii::app()->createUrl('admin/prize/prize'));
	}

public function actionUpdate()
{
 $listid = Yii::app()->request->getParam('id');
        $this->pageTitle='Edit Winner Details - Business Supermarket';
        if(isset($listid) && $listid !=""){            
            $model = PrizeDrawWinners::model()->find("id  ='".$listid."'");   
            $model->attributes=$_POST['PrizeDrawWinners'];           
            
        }else {
            $model = new PrizeDrawWinners; 
            $model->attributes=$_POST['PrizeDrawWinners'];
        }
		
		
        
       if(isset($_POST['PrizeDrawWinners']))
		   {

            	$model->attributes=$_POST['PrizeDrawWinners'];
                    $model->amount_paid_date=$_POST['PrizeDrawWinners']['amount_paid_date'];
                if($model->save())
    			{    
    		 	
	 					//$this->redirect(Yii::app()->createUrl('admin/slider/slider'));
					

                }
            

					 
 $this->redirect(Yii::app()->createUrl('admin/prize/prize'));
 }
		
		$this->render('update',array('model'=>$model,));
}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Prize('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Prize']))
			$model->attributes=$_GET['Prize'];

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
		$model=Prize::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
}