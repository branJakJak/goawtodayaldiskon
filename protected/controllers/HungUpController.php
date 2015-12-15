<?php 
/**
* HungUpController
*/
class HungUpController extends Controller
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
				'actions'=>array('agent'),
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}


    public function actionAgent($agent)
    {
        $remote = new GoAutodialRemote();
        $res = $remote->hungUp($agent);
        if (stripos($res, "SUCCESS") !== false ) {
        	Yii::app()->user->setFlash("success","Success");
	        if (Yii::app()->request->isAjaxRequest) {
	        	header("Content-Type: application/json");
	        	echo new SuccessJsonResponse();
	        	Yii::app()->end();
	        }else{
	            $this->redirect(array('site/index'));
        	}
        }else if (stripos($res, "ERROR") !== false) {
			Yii::app()->user->setFlash("error","Action failed");
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