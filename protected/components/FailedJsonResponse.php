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

    function __construct()
    {
        $this->message = array(
            "status" => 'failed',
            "message" => 'failed',
        );
    }

    function __toString()
    {
        return json_encode($this->message);
    }


}