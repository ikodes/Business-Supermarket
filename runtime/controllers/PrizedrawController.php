<?php

class PrizedrawController extends Controller

{

public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','winner_gallery','user_points'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()

	{
$this->pageTitle='Prize Draw - Business Supermarket';
		$this->render('index');

	}
public function actionWinner_gallery()

	{

		$this->render('winner_gallery');

	}
	public function actionUser_points()

	{
$this->pageTitle='User Points - Business Supermarket';
		$this->render('user_points');

	}


	// Uncomment the following methods and override them if needed

	/*

	public function filters()

	{

		// return the filter configuration for this controller, e.g.:

		return array(

			'inlineFilterName',

			array(

				'class'=>'path.to.FilterClass',

				'propertyName'=>'propertyValue',

			),

		);

	}



	public function actions()

	{

		// return external action classes, e.g.:

		return array(

			'action1'=>'path.to.ActionClass',

			'action2'=>array(

				'class'=>'path.to.AnotherActionClass',

				'propertyName'=>'propertyValue',

			),

		);

	}

	*/

}