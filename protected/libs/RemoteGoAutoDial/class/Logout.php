<?php


class Logout extends BaseGoAutodialRemote implements GoAutodialRemoteCommandInterface
{

    function __construct($agent_name, $function_name = "logout", $param_value = "LOGOUT")
    {
        $this->setAgentUser($agent_name);
        $this->setFunctionName($function_name);
        $this->setValueParam($param_value);

    }

    public function send()
    {
        $httParams = array(
            "function" => $this->getFunctionName(),
            "agent_user" => $this->getAgentUser(),
            "value" => $this->getValueParam(),
        );
        return $this->send($httParams);
    }


}