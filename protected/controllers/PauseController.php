<?php 
/**
* PauseController
*/
class PauseController extends CController
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			array('allow',
				'actions'=>array('agent','changePauseCode'),
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}
	public function actionAgent($agent , $pause_code)
	{
        $remote = new GoAutodialRemote();
        $res = $remote->pause($agent);
        if (stripos($res, "SUCCESS") !== false ) {
        	Yii::app()->user->setFlash("success","Pause code updated");
        }else if (stripos($res, "ERROR") !== false) {
			Yii::app()->user->setFlash("error","Pause code update failed");
        }
        if (Yii::app()->request->isAjaxRequest) {
        	header("Content-Type: application/json");
        	echo new SuccessJsonResponse();
        	Yii::app()->end();
        }else{
            $this->redirect(array('site/index'));
        }
	}
	public function actionChangePauseCode($user_agent ,$pause_code)
	{
        $remote = new GoAutodialRemote();
        $res = $remote->changePauseCode($agent ,"pause_code" , $pause_code );
        if (stripos($res, "SUCCESS") !== false ) {
        	Yii::app()->user->setFlash("success","Pause code updated");
	        if (Yii::app()->request->isAjaxRequest) {
	        	header("Content-Type: application/json");
	        	echo new SuccessJsonResponse();
	        	Yii::app()->end();
	        }else{
	            $this->redirect(array('site/index'));
        	}
        }else if (stripos($res, "ERROR") !== false) {
			Yii::app()->user->setFlash("error","Pause code update failed");
	        if (Yii::app()->request->isAjaxRequest) {
	        	header("Content-Type: application/json");
	        	echo new FailedJsonResponse();
	        	Yii::app()->end();
	        }else{
            	$this->redirect(array('site/index'));
        	}
        }
	}
}