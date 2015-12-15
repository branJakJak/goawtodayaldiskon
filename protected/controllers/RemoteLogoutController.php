<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kevin
 * Date: 12/15/15
 * Time: 11:27 PM
 * To change this template use File | Settings | File Templates.
 */

class RemoteLogoutController extends Controller
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
                'actions' => array('agent','all'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionAgent($agent)
    {
        $remote = new GoAutodialRemote();
        $res = $remote->logout($agent);
        if (stripos($res, "SUCCESS") !== false) {
            Yii::app()->user->setFlash("success", "Agent paused");
        } else if (stripos($res, "ERROR") !== false) {
            Yii::app()->user->setFlash("error", "Pause action failed");
        }
        if (Yii::app()->request->isAjaxRequest) {
            header("Content-Type: application/json");
            echo new SuccessJsonResponse();
            Yii::app()->end();
        } else {
            $this->redirect(array('site/index'));
        }
    }
    public function actionAll(){
        $remote = new GoAutodialRemote();
        $res = $remote->logoutAll();
        if (stripos($res, "SUCCESS") !== false) {
            Yii::app()->user->setFlash("success", "Agent paused");
        } else if (stripos($res, "ERROR") !== false) {
            Yii::app()->user->setFlash("error", "Pause action failed");
        }
        if (Yii::app()->request->isAjaxRequest) {
            header("Content-Type: application/json");
            echo new SuccessJsonResponse();
            Yii::app()->end();
        } else {
            $this->redirect(array('site/index'));
        }

    }


}