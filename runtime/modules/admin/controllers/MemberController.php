<?php

class MemberController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='/layouts/column2';
    public $member;

    public function init()
    {
        parent::init();
    }
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            //'postOnly + delete', // we only allow deletion via POST request
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
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('delete','index','view','create','update','sendmail','suspend','activate','del','business','Updatenotifyemail'),
                'users'=>array('admin'),
            ),
            array('allow',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Member;

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if(isset($_POST['Member']))
        {
			$model->user_default_account_status = "1";
			$model->user_default_registration_date = date('Y-m-d');
            $model->attributes=$_POST['Member'];
			$model->user_default_gender = $_POST['gender'];
			$fdob=$_POST['dob'];
               list($day1, $month1, $year) = explode("/", $fdob);
			    if(strlen($month1)=="1")
			    {
				   $month =	"0".$month1;			   
			    }
				else
				{
					 $month = $month1;	
				}
				
				if(strlen($day1)=="1")
			    {
				   $day =	"0".$day1;			   
			    }
				else
				{
					 $day = $day1;	
				}
             $dob = "$year-$month-$day";
			   $date_regex = '/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/';
			   if (!preg_match($date_regex, $dob)) 
			   {
			   	echo CJSON::encode(array('success'=>false,'message'=>"User not registered !"));
               // Yii::app()->end();
			   // $this->render('create',array('model'=>$model,));die;
			   }
			   else
			   {
			   $model->user_default_dob = $dob;		
			//print_r($model->attributes);
			if($model->save())
            {    
				$address = new Useraddress;
				$address->user_default_profile_id=$model->user_default_id;
				$address->attributes=$_POST['Useraddress'];
				$address->save();
                Yii::app()->user->setFlash('success', 'User Profile Updated Successfully.');
                //$this->redirect(array('view','id'=>$model->user_default_id));
				  $this->redirect(array('index'));

            }
			
				}
        }

        $this->render('create',array('model'=>$model,));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {

        $this->setPageTitle('');
        $model=$this->loadModel($id);

        if($model->user_default_type=='business')
            $model->scenario='business';
        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);


        // $criteria = new CDbCriteria;
        // $criteria->compare('user_default_uid',$model->user_default_uid,true);
        // $criteria->order = 'user_default_lid desc';
        // $total = Userlisting::model()->count($criteria);
        // $count = 5;

        // $pages = new CPagination($total);
        // $pages->setPageSize($count);
        // $pages->applyLimit($criteria);
        // $posts = Userlisting::model()->findAll($criteria);


        $this->render('update',array(
            // 'list'=>$posts,
            // 'pages' => $pages,
            // 'item_count'=>$total,
            // 'page_size'=>$count,
            'model'=>$model,
            'total' =>Member::model()->count(),
        ));
    }

    /* public function actionUpdate($id)
     {
         $this->setPageTitle('');
         $model=$this->loadModel($id);
         if($model->user_default_type=='business')
             $model->scenario='business';
         // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);

         if(isset($_POST['Member']) || !empty($_POST['member']))
         {
             //print_r($_POST);die;
             $model->attributes=$_POST['Member'];

             if($model->save()){
                 Yii::app()->user->setFlash('success', 'User Profile Updated Successfully.');
                 if($model->user_default_type=='user')
                     $this->redirect(array('index'));
                 else
                     $this->redirect(array('/admin/member/business'));
             }
         }
         // $criteria = new CDbCriteria;
         // $criteria->compare('user_default_uid',$model->user_default_uid,true);
         // $criteria->order = 'user_default_lid desc';
         // $total = Userlisting::model()->count($criteria);
         // $count = 5;

         // $pages = new CPagination($total);
         // $pages->setPageSize($count);
         // $pages->applyLimit($criteria);
         // $posts = Userlisting::model()->findAll($criteria);

         $this->render('update',array(
             // 'list'=>$posts,
             // 'pages' => $pages,
             // 'item_count'=>$total,
             // 'page_size'=>$count,
             'model'=>$model,
             'total' =>Member::model()->count(),
         ));
     }*/

    public function actionUpdatenotifyemail()
    {

        $this->setPageTitle('');
        $model=$this->loadModel($_POST['id']);

        $subject = $_POST['update_subject'];
        $message =$_POST['message'];

        $bodyMessage = rtrim(ltrim($message,"<p>"),"</p>");

        if($bodyMessage ==""){

            echo 'fail';
        }
        else {
            $template =  MailTemplate::getTemplate('User_profile_update_notification');
			 $contactlink = '<a href="'.Yii::app()->getBaseUrl(true).'/contact" target="_blank" >customer support team</a>';
            //$template =  MailTemplate::model()->findByAttributes(array('template_id'=>112));
            $string = array(
                '{{#USERNAME#}}'=>ucwords($model->user_default_first_name .' '.$model->user_default_surname),
                '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                '{{#MESSAGE#}}' =>$bodyMessage,
				'{{#CSLINK#}}'=>$contactlink,
                '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
            );

            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
            SharedFunctions::app()->sendmail($model->user_default_email,$subject,$body);

        }

        $model->attributes=$_POST['Member'];
		$postid = $_POST['id'];
		$address = Useraddress::model()->find(
                              array(
                              'condition'=>'user_default_profile_id= "'.$postid.'" ',
                              'order'=>'user_default_address_id DESC'
                             )); 
		if($address)
	{
		
	}
	else
	{
		$address = new Useraddress;
		$address->user_default_profile_id=$postid ;
	}
        $address->attributes=$_POST['Useraddress'];
		$address->save();
        if($model->save()){
            Yii::app()->user->setFlash('success', 'User Profile Updated Successfully.');
            echo 'success';
        }

    }

    public function actionGenerateChart(){
        Yii::app()->fusioncharts->setChartOptions( array( 'caption'=>'Member hours logged for July 2014', 'xAxisName'=>'Week Days', 'yAxisName'=>'Hours' ) );

        $categories = array(
            array('label'=>'Sunday'),
            array('label'=>'Monday'),
            array('label'=>'Tuesday'),
            array('label'=>'Wednesday'),
            array('label'=>'Thursday'),
            array('label'=>'Friday'),
            array('label'=>'Saturday')
        );

        Yii::app()->fusioncharts->addCategories($categories);

        $sets = array(
            array('value'=>'2'),
            array('value'=>'4'),
            array('value'=>'3'),
            array('value'=>'6'),
            array('value'=>'5'),
            array('value'=>'9'),
            array('value'=>'4')
        );

        Yii::app()->fusioncharts->addDataSet('Week1',array('seriesName'=>'Week1'));
        foreach ($sets as $set) {
            Yii::app()->fusioncharts->addSetToDataSet('Week1',$set);
        }
        Yii::app()->fusioncharts->addDataSet('Week2',array('seriesName'=>'Week2'));
        foreach ($sets as $set) {
            Yii::app()->fusioncharts->addSetToDataSet('Week2',$set);
        }
        Yii::app()->fusioncharts->addDataSet('Week3',array('seriesName'=>'Week3'));
        foreach ($sets as $set) {
            Yii::app()->fusioncharts->addSetToDataSet('Week3',$set);
        }
        Yii::app()->fusioncharts->addDataSet('Week4',array('seriesName'=>'Week4'));
        foreach ($sets as $set) {
            Yii::app()->fusioncharts->addSetToDataSet('Week4',$set);
        }

        Yii::app()->fusioncharts->addDefinition(array('name'=>'CanvasAnim', 'type'=>'animation', 'param'=>'_xScale', 'start'=>'0', 'duration'=>'1'));
        Yii::app()->fusioncharts->addApplication(array('toObject'=>'Canvas', 'styles'=>'CanvasAnim'));
        Yii::app()->fusioncharts->getXMLData();
    }

    public function actionUserActivityChart($user_id,$year='',$month=''){
        $year = (int)$year?:date('Y');
        $month = (int)$month?:date('m');
        $chart_month = $year.'-'.$month.'-01';
        Yii::app()->fusioncharts->setChartOptions( array( 'caption'=>'Member hours logged for '.date('F Y',strtotime($chart_month)), 'xAxisName'=>'Week Days', 'yAxisName'=>'Hours' ) );

        $categories = array(
            array('label'=>'Sunday'),
            array('label'=>'Monday'),
            array('label'=>'Tuesday'),
            array('label'=>'Wednesday'),
            array('label'=>'Thursday'),
            array('label'=>'Friday'),
            array('label'=>'Saturday')
        );

        Yii::app()->fusioncharts->addCategories($categories);

        $criteria = new CDbCriteria;
        $criteria->select = "t.*,weekday(t.date) as `weekday`, (floor((day(t.date)-1) / 7) + 1) as `week`";
        $criteria->condition = "t.user_default_id='".(int)$user_id."' AND YEAR(t.date)='$year' AND MONTH(t.date)='$month'";
        $user_logs = ActivityDate::model()->findAll($criteria);
        // echo "<pre>";print_r($user_logs);die;

        if($user_logs){
            $chartData = array();
            foreach ($user_logs as $log) {
                $weekday = $log->weekday==6?0:($log->weekday+1);
                $chartData[$log->week][$weekday] = number_format($log->total_minutes/60,1);
            }
            if(isset($chartData[5]))
                $total_weeks = 5;
            else
                $total_weeks = 4;
            for($week=1;$week<=$total_weeks;$week++){
                Yii::app()->fusioncharts->addDataSet('Week'.$week,array('seriesName'=>'Week '.$week));
                for($day=0;$day<7;$day++){
                    Yii::app()->fusioncharts->addSetToDataSet('Week'.$week,array('value'=>isset($chartData[$week][$day])?$chartData[$week][$day]:0));
                }
            }
        }
        Yii::app()->fusioncharts->addDefinition(array('name'=>'CanvasAnim', 'type'=>'animation', 'param'=>'_xScale', 'start'=>'0', 'duration'=>'1'));
        Yii::app()->fusioncharts->addApplication(array('toObject'=>'Canvas', 'styles'=>'CanvasAnim'));
        Yii::app()->fusioncharts->getXMLData();
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
		
		/*$criteria = new CDbCriteria;
        $criteria->addInCondition('user_default_profile_id',$id);
        $add = Useraddress::model()->deleteAll($criteria);
		print_r($add);
		$query = "delete from `user_default_addresses` where `user_default_profile_id`='$id'";
         $query->queryAll($query);*/
		 Useraddress::model()->deleteAll("user_default_profile_id ='" . $id . "'");
		$userlisting =  Userlisting::model()->findAll("user_default_profiles_id ='" . $id . "'");
		foreach ($userlisting as $user)
		{
			$l = $user['user_default_listing_id'];
			Listingaddress::model()->deleteAll("user_default_listing_id ='" . $l . "'");
			Userlistingimages::model()->deleteAll("user_default_listing_id ='" . $l . "'");
			Userlistingvideos::model()->deleteAll("user_default_listing_id ='" . $l . "'");
			
		}
		 Userlisting::model()->deleteAll("user_default_profiles_id ='" . $id . "'"); 
		 
		
		$this->loadModel($id)->delete();
		
        $this->redirect(array('index'));

    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
		 
		 
        /*$dataProvider=new CActiveDataProvider('Member');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));*/

        // Set default value to numbe of member record
        Yii::app()->user->setState('pageSize', 10);

        if ( isset($_POST['more_record']) ) {

            Yii::app()->user->setState('pageSize', $_POST['more_record']);

            unset($_POST['more_record']);

        }

        $model=new Member('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Member']))
            $model->attributes=$_GET['Member'];

        $model->user_default_type='user';

        $this->render('index',array(
            'model'=>$model,
            'userType' => 'user'
        ));
    }

    public function actionBusiness(){

        // Set default value to numbe of member record
        Yii::app()->user->setState('pageSize', 10);

        if ( isset($_POST['more_record']) ) {

            Yii::app()->user->setState('pageSize', $_POST['more_record']);

            unset($_POST['more_record']);

        }

        $model=new Member('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Member']))
            $model->attributes=$_GET['Member'];

        $model->user_default_type='business';

        $this->render('index',array(
            'model'=>$model,
            'userType' => 'business'
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Member the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Member::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Member $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='member-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDel($id){
        $model =$this->loadModel($id);
        /*$businessListing = New Businesslisting;
        $command = Yii::app()->db->createCommand();
        $command->delete('user_default_business_listing', 'user_default_uid=:user_default_uid', array(':user_default_uid'=>$model->user_default_uid));
        $this->loadModel($id)->delete();*/

        //$template =  MailTemplate::model()->findByAttributes(array('template_id'=>111));
        $template =  MailTemplate::getTemplate('Delete_Account');

        $string = array(
            '{{#USERNAME#}}'=>ucwords($model->user_default_first_name .' '.$model->user_default_surname),
            '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
            '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
            '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email']
        );
        $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
        SharedFunctions::app()->sendmail($model->user_default_email,$template->template_subject,$body);

        if($model->user_default_type=='user')
            $this->redirect(array('index'));
        else
            $this->redirect(array('/admin/member/business'));
    }

    /* Send mail from member when edit the profile */
    public function actionSendmail(){

        $model = $this->loadModel($_POST['id']);
        $subject = Yii::app()->request->getParam('subject');
        $message= Yii::app()->request->getParam('message');

        if($subject =='' || $message ==''){
            echo 'fail';
        }
        else {
            $bodyMessage = rtrim(ltrim($message, "<p>"), "</p>");
            $template = MailTemplate::getTemplate('Send_Email');
            //   $template =  MailTemplate::model()->findByAttributes(array('template_id'=>100));
            $string = array(
                '{{#USERNAME#}}' => ucwords($model->user_default_first_name . ' ' . $model->user_default_surname),
                '{{#MESSAGE#}}' => $bodyMessage,
                '{{#COMPANY_NAME#}}' => Yii::app()->params['company_name'],
                '{{#COMPANY_SIGNATURE#}}' => Yii::app()->params['signature'],
                '{{#COMPANY_EMAIL#}}' => Yii::app()->params['company_email']
            );

            $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);
            $result = SharedFunctions::app()->sendmail($model->user_default_email, $subject, $body);

            if ($result) {
                echo 'success';
            }
        }
    }


    /* Active account */
    public function actionActivate(){
        $model=new Member;
        $model = $this->loadModel(Yii::app()->request->getParam('id'));

        $subject = Yii::app()->request->getParam('subject');
        $message= Yii::app()->request->getParam('message');

        if($subject !='' && $message !='') {
            $bodyMessage = rtrim(ltrim($message, "<p>"), "</p>");
            $template = MailTemplate::getTemplate('Account_Activation_Notice');
			$contactlink = '<a href="'.Yii::app()->getBaseUrl(true).'/contact" target="_blank" >customer support team</a>';
            //$template =  MailTemplate::model()->findByAttributes(array('template_id'=>113));
            $string = array(
                '{{#USERNAME#}}' => ucwords($model->user_default_first_name . ' ' . $model->user_default_surname),
                '{{#COMPANY_NAME#}}' => Yii::app()->params['company_name'],
                '{{#COMPANY_SIGNATURE#}}' => Yii::app()->params['signature'],
                '{{#MESSAGE#}}' => $bodyMessage,
				'{{#LINK#}}' => $contactlink,
                '{{#COMPANY_EMAIL#}}' => Yii::app()->params['company_email']
            );
            $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);
            $result = SharedFunctions::app()->sendmail($model->user_default_email, $template->template_subject, $body);
            if (isset($model) && $result) {

                $user = Member::model()->findByPk(Yii::app()->request->getParam('id'));
                $user->user_default_account_status = '1';
                $user->update();
                echo 'success';
            }
        }
        else
        {
            echo 'fail';
        }


    }

    /* Suspend account */
    public function actionSuspend(){
        $model = $this->loadModel(Yii::app()->request->getParam('id'));
        if(isset($model)){
            $model->user_default_account_status = '2';
            if($model->save()){

                $subject = Yii::app()->request->getParam('subject');
                $message= Yii::app()->request->getParam('message');
                $bodyMessage = rtrim(ltrim($message,"<p>"),"</p>");
                //	$template =  MailTemplate::model()->findByAttributes(array('template_id'=>109));
                $template =  MailTemplate::getTemplate('Account_suspension_notice');
$link = '<a href="'.Yii::app()->getBaseUrl(true).'/confirm_identity/id/'.$model->user_default_id.'" target="_blank" >here >> </a>';					
                $string = array(
                    '{{#USERNAME#}}'=>ucwords($model->user_default_first_name .' '.$model->user_default_surname),
                    '{{#LINK#}}'=>ucwords($link),
                );
                $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
                $result =SharedFunctions::app()->sendmail($model->user_default_email,$subject,$body);
            }
            if($result)
            {
                echo 'success';
            }
            else
            {
                echo 'fail';
            }
        }

        //$this->render('update',array('model'=>$model,));
        //$this->redirect(array('/member'));
    }


    public function actionRecent()
    {
        unset(Yii::app()->request->cookies['from_date']);  // first unset cookie for dates
        unset(Yii::app()->request->cookies['to_date']);
        $model=new Member('search');
        $model->unsetAttributes();  // clear any default values

        if(isset($_GET['Member']))
            $model->attributes=$_GET['Member'];

        if(isset($_GET['from_date'])) $model->from_date = $_GET['from_date']; //else $model->from_date = date('Y-m-d');
        if(isset($_GET['to_date'])) $model->to_date = $_GET['to_date']; //else $model->to_date = date('Y-m-d');
        $this->render('recent',array(
            'model'=>$model,
        ));
    }

    public function actionSendnewregcsv()
    {
        $model=new Member('search');
        $filename = 'BusinessSupermarket-'.date('Y-m-d').'.csv';
        $this->widget('application.modules.admin.models.EExcelView', array(
            'dataProvider'=> $model->search2(),
            'title'=>'Business Supermarket',
            'stream'=> false,
            'grid_mode'=>'export',
            'filename'=> $filename,
            'exportType'=>'CSV',
            'columns'=>array(
                'user_default_username',
                array('header' => 'Type', 'name' => 'user_default_type','value' => '$data->user_default_type'),
                array('header' => 'Date', 'name' => 'user_default_rdate','value' => '$data->user_default_rdate'),
                array('header' => 'Activated', 'name' => 'user_default_account_status','value' => '$data->user_default_account_status'),
            ),
        ));
        $subject='New User Registration Csv File';
        $body = 'Please find the attached excel file of new user registration.';
        $attachment = Yii::app()->basePath.'/../www/upload/documents/'.$filename;
        $to = array('admin@business-supermarket.com','dsp7@blueyonder.co.uk');//Yii::app()->params['adminEmail'];
        SharedFunctions::sendmail($to,$subject,$body,$attachment);
        $this->redirect('/admin/member/recent');
    }


    public function actionMarketing(){

        $model_marketing_form = new MarketingForm();


        if ((Yii::app()->request->getParam('send') !='')) {
            $model_marketing_form->body = $_POST['MarketingForm']['body'];
            $model_marketing_form->subject= $_POST['MarketingForm']['subject'];
            $model_marketing_form->status= $_POST['MarketingForm']['status'];
            $model_marketing_form->category = $_POST['MarketingForm']['category'];
            $model_marketing_form->sector = $_POST['MarketingForm']['sector'];
            $model_marketing_form->country = $_POST['MarketingForm']['country'];
            if($model_marketing_form->validate()){


                $sql = "SELECT `user_default_email`, `user_default_first_name`, `user_default_surname` FROM  user_default_user AS t1";

                if( $model_marketing_form->category){
                    $sql .= "  INNER JOIN user_default_user_listing AS ul ON t1.user_default_uid = ul.user_default_uid
                    INNER JOIN user_default_listing_category AS c ON c.list_category_id=ul.user_default_category";
                }
                if( $model_marketing_form->sector){
                    $sql .= " INNER JOIN user_default_listing_profession AS lp ON lp.list_profession_id = t1.co_sector";
                }
                if( $model_marketing_form->country !="Worldwide"){
                    $sql .= " INNER JOIN user_default_country AS cu ON cu.country_id=t1.user_default_country";
                }
                if($model_marketing_form->status || $model_marketing_form->category || $model_marketing_form->sector || $model_marketing_form->country) {
                    $sql .= ' WHERE 1 ';
                }
                if( $model_marketing_form->status){
                    $sql .= "  AND t1.co_title = '$model_marketing_form->status'  ";
                }
                if( $model_marketing_form->category){
                    $sql .= "     AND ul.user_default_category = $model_marketing_form->category";
                }
                if( $model_marketing_form->sector){
                    $sql .= " AND t1.co_sector = $model_marketing_form->sector ";
                }
                if( $model_marketing_form->country !='Worldwide'){
                    $sql .= " AND t1.user_default_country = '$model_marketing_form->country' ";
                }

                $command = Yii::app()->db->createCommand($sql);
                $users = $command->queryAll();
                //$users = Member::model()->findAll(array("select" => array("user_default_email", "user_default_first_name", "user_default_surname"), "order" => "user_default_id DESC"));

                $subject = $model_marketing_form->subject;
                $message = $model_marketing_form->body;
                $bodyMessage = rtrim(ltrim($message, "<p>"), "</p>");

                $template = MailTemplate::getTemplate('Marketing_Email');

                $emails = array();
                foreach ($users as $user_data) {
                    $emails[] = $user_data['user_default_email'];

                    $string = array(
                        '{{#USERNAME#}}' => ucwords($user_data['user_default_first_name'] . ' ' . $user_data['user_default_surname']),
                        '{{#MESSAGE#}}' => $bodyMessage,
                        '{{#COMPANY_NAME#}}' => Yii::app()->params['company_name'],
                        '{{#COMPANY_SIGNATURE#}}' => Yii::app()->params['signature'],
                        '{{#COMPANY_EMAIL#}}' => Yii::app()->params['company_email']
                    );
                    $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);
                    $result = SharedFunctions::app()->sendmail($user_data['user_default_email'], $subject, $body);


                }

                if($result){

                    $this->redirect(Yii::app()->createUrl('admin/dashboard'));
                }
                else
                {
                    $send_mail_error = '<p>Mail could not be sent</p>';
                    Yii::app()->user->setFlash('send_mail_error', 'Mail could not be sent');

                }

                $this->redirect(Yii::app()->createUrl('admin/dashboard'));
            }}
        $this->render('marketing', array(
            'model' => $model_marketing_form,
        ));
    }
}