<?php


class Hungup extends BaseGoAutodialRemote implements GoAutodialRemoteCommandInterface{

    function __construct($agent_name, $function_name="external_hangup", $param_value="1")
    {
        $this->setAgentUser($agent_name);
        $this->setFunctionName($agent_name);
        $this->setValueParam($param_value);
    }

    public function send()
    {
        $otherParams = array(
            "agent_user" =>$this->getAgentUser(),
            "function" =>"external_hangup",
            "value" =>"1",
        );
        $this->send($otherParams);
        $otherParams = array(
            "agent_user" =>$this->getAgentUser(),
            "function" =>"external_status",
            "value" =>"DCMGR",
        );
        $this->send($otherParams);
    }
}