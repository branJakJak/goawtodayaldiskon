<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kevin
 * Date: 12/15/15
 * Time: 11:23 PM
 * To change this template use File | Settings | File Templates.
 */

class BaseJsonResponse {
    public $message = array();

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }


}