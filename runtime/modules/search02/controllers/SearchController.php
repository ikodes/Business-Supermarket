<?php
class SearchController extends Controller
{
	public $layout='//layouts/column2';
    public static $searchViewOffset = 0;
	
	/*
	* to filter the access
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    /**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

    public function actionIndex()
    {
        $keyword = (isset($_POST['serachKey']) ? $_POST['serachKey'] : NULL);

        $this->render('/search/searchResult',array(
            'searchKey'=>$keyword
        ));

    }
    public function actionNavigate(){


        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : SearchClass::$searchViewLimit;
        $pageSelected = ( isset($_POST['pageSelected']) ) ? $_POST['pageSelected'] : 1;
        $viewOffsetValue = ( isset($_POST['viewOffsetValue']) ) ? $_POST['viewOffsetValue'] : SearchClass::$searchViewOffset;
        $searchOrderBy = ( isset($_POST['searchOrderBy']) ) ? $_POST['searchOrderBy'] : SearchClass::$searchOrderBy;

        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }

        $listingView = $this->renderPartial('/search/searchResult', array(
            'searchKey' => $listingId,
            'searchViewLimit' => $viewLimitValue,
            'searchViewOffset' => $viewOffsetValue,
            'searchOrderBy' => $searchOrderBy,
            'pageSelected' => $pageSelected
        ), true);

       echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));
    }

    public function actionSetViewByCriteria(){

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : SearchClass::$searchViewLimit;
        $searchOrderBy = ( isset($_POST['searchOrderBy']) ) ? $_POST['searchOrderBy'] : SearchClass::$searchOrderBy;

        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }

       //$listing = Userlisting::model()->findByPk($listingId);

        $listingView = $this->renderPartial('/search/searchResult', array(
            'searchKey' => $listingId,
            'searchViewLimit' => $viewLimitValue,
            'searchViewOffset' => SearchClass::$searchViewOffset,
            'searchOrderBy' => $searchOrderBy
        ), true);

        echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));
    }

    public function actionUpdateViewLimit(){

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : SearchClass::$searchViewLimit;
        $searchOrderBy = ( isset($_POST['searchOrderBy']) ) ? $_POST['searchOrderBy'] : SearchClass::$searchOrderBy;


        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }

        // Render the forum page with the new paramters
        $listingView = $this->renderPartial('/search/searchResult',
            array(
                'searchKey' => $listingId,
                'searchViewLimit' => $viewLimitValue,
                'searchViewOffset' => SearchClass::$searchViewOffset,
                'searchOrderBy' => $searchOrderBy
            ), true);

        echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));


    }

    public function actionsearchByRelevanceTitle(){

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $criteria = ( isset($_POST['criteria']) ) ? $_POST['criteria'] : SearchClass::$searchCriteria;
        $searchOrderBy = ( isset($_POST['searchOrderBy']) ) ? $_POST['searchOrderBy'] : SearchClass::$searchOrderBy;


        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }

        // Render the forum page with the new paramters
        $listingView = $this->renderPartial('/search/searchResult',
            array(
                'searchKey' => $listingId,
                'searchViewLimit' => SearchClass::$searchViewLimit,
                'searchViewOffset' => SearchClass::$searchViewOffset,
                'searchOrderBy' => $searchOrderBy,
                'searchCriteria'=>$criteria
            ), true);

        echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));


    }



}
