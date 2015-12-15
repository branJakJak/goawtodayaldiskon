<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kevin
 * Date: 12/16/15
 * Time: 12:28 AM
 * To change this template use File | Settings | File Templates.
 */

class FailedJsonResponse extends BaseJsonResponse
{

    public function __construct()
    {
        $this->status = "failed";
        $this->messageContent = "failed";
        $this->message = array(
            "status" => $this->status,
            "message" => $this->messageContent,
        );
    }



}