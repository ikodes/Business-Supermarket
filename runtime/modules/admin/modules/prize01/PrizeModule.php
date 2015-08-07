<?php

class PrizeModule extends CWebModule
{
   //public $defaultController = 'Prize';
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		
       
        $this->setImport(array(
			'prize.models.*',
			'prize.components.*',
		));
          
        	$this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'prize/default/error'),
                'user' => array(
                'class' => 'CWebUser',             
                'loginUrl' => Yii::app()->createUrl('prize/default/login'),
            )
        ));
        
        $this->layoutPath = Yii::getPathOfAlias('application.modules.admin.views.layouts');
	}

 	 public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	} 
    
    	  
}
