<?php 

/**
* SuccessJsonResponse
*/
class SuccessJsonResponse extends BaseJsonResponse
{

   public function __construct()
    {
        $this->status = "ok";
        $this->messageContent = "success";
        $this->message = array(
            "status" => $this->status,
            "message" => $this->messageContent,
        );
    }
}