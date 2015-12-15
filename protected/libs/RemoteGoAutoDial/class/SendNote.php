<?php


class SendNote extends BaseGoAutodialRemote implements GoAutodialRemoteCommandInterface
{
    protected $notes;
    protected $ranks;

    function __construct($agent_name, $function_name = "set_timer_action", $param_value = "MESSAGE_ONLY" , $notes , $rank)
    {
        $this->setAgentUser($agent_name);
        $this->setFunctionName($function_name);
        $this->setValueParam($param_value);
        $this->setNotes($notes);
        $this->setRanks($rank);
    }

    public function send()
    {
        $otherParams = array(
            "agent_user" => $this->getAgentUser(),
            "function" => $this->getFunctionName(),
            "value" => $this->getValueParam(),
            "notes" => $this->getNotes(),
            "rank" => $this->getRanks()
        );
        $this->send($otherParams);
    }
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setRanks($ranks)
    {
        $this->ranks = $ranks;
    }

    public function getRanks()
    {
        return $this->ranks;
    }


}