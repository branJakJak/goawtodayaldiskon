<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kevin
 * Date: 12/16/15
 * Time: 4:38 AM
 * To change this template use File | Settings | File Templates.
 */

class PauseCode extends BaseGoAutodialRemote implements GoAutodialRemoteCommandInterface
{
    function __construct($agent_name, $function_name="external_pause", $param_value="PAUSE")
    {
        $this->setAgentUser($agent_name);
        $this->setFunctionName($agent_name);
        $this->setValueParam($param_value);
    }

    public function send()
    {
        $httParams = array(
            "agent_user" => $this->getAgentUser(),
            "function" => $this->getFunctionName(),
            "value" => $this->getValueParam()
        );
        $this->send($httParams);
    }

}