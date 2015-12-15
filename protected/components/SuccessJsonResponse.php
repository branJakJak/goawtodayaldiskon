<?php 

/**
* SuccessJsonResponse
*/
class SuccessJsonResponse extends BaseJsonResponse
{

    function __construct()
    {
        $this->message = array(
            "status"=>'ok',
            "message"=>'success',
        );
    }

    function __toString()
    {
        return json_encode($this->message);
    }


}