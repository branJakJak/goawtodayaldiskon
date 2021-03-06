<?php 

class AgentController extends Controller
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
				'actions'=>array('json','showScreen'),
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}
    public function actionJson()
    {
    	header("Content-Type: application/json");
		$remoteAgents = new GoAutoDialRemoteUser();
		$alldata = $remoteAgents->getAll();
		echo json_encode($alldata);
    }
    public function actionShowScreen($user , $message)
    {
        $remote = new GoAutodialRemote();
        $res = $remote->sendNote($user,$message);
        if (stripos($res, "SUCCESS") !== false ) {
        	Yii::app()->user->setFlash("success","Message sent");
        	if (Yii::app()->request->isAjaxRequest) {
        		header("Content-Type: application/json");
	        	echo new SuccessJsonResponse();
	        	Yii::app()->end();
        	}else{
        		$this->redirect(array('site/index'));
        	}
        }else if (stripos($res, "ERROR") !== false) {
			Yii::app()->user->setFlash("error","Cant send message");
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