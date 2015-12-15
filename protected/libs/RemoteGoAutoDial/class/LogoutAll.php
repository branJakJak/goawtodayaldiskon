<?php


class LogoutAll extends BaseGoAutodialRemote implements GoAutodialRemoteCommandInterface
{

    function __construct($function_name = "logout_all", $param_value = "LOGOUT")
    {
        $this->setFunctionName($function_name);
        $this->setValueParam($param_value);
    }

    public function send()
    {
        $httParams = array(
            "function" => $this->getFunctionName(),
            "value" => $this->getValueParam(),
        );
        return $this->send($httParams);
    }


}