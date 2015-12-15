<?php

/**
 * 
 */
class DisconnectController extends CController
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
        $res = 
        $remote->send($agent);
        if (stripos($res, "SUCCESS") !== false ) {
        	Yii::app()->user->setFlash("success","Agent disconnected");
        }else if (stripos($res, "ERROR") !== false) {
			Yii::app()->user->setFlash("error","Disconnection failed");
        }
        $this->redirect(array('site/index'));
    }

}