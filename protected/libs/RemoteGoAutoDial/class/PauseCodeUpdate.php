<?php


class PauseCodeUpdate  extends BaseGoAutodialRemote implements GoAutodialRemoteCommandInterface{
    function __construct($agent_name, $function_name="set_timer_action", $param_value="MESSAGE_ONLY")
    {
        $this->setAgentUser($agent_name);
        $this->setFunctionName($function_name);
        $this->setValueParam($param_value);

    }

    public function send()
    {
        $httParams = array(
            "function" =>$this->getFunctionName(),
            "agent_user" =>$this->getAgentUser(),
            "value" =>$this->getValueParam(),
        );
        $this->send($httParams);
    }


}