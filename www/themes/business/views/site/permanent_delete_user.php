<?php 

$date=date('Y-m-d');

$connection = Yii::app()->db;

$cronsql = $connection->createCommand("select * from `drg_user` where `drg_active_link`!=''");

$cronresult = $cronsql->queryAll();

foreach($cronresult as $data )

{

$deldate=$data['drg_rdate'];

$dd="21 days";

$newtime = strtotime($deldate . ' + '.$dd);

$ddate = date('Y-m-d', $newtime);

if($ddate==$date)

{

$to=$data['drg_email'];

$template =  MailTemplate::getTemplate('Account_permanent_delete');

$subjectcc="Your account is dormant";

$string = array(        
						'{{#USERNAME#}}'=>ucwords($data['drg_name'].' '.$data['drg_surname'])

						);

$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);

$result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);



}

}

?>