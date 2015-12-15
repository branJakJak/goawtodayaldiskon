<?php 

/**
* BaseGoAutodialRemote
*/
class BaseGoAutodialRemote
{
	const USERNAME = "itsupport";
	const PASSWORD = "mad4itnow2015";
	const SOURCE = "RECONT";

    protected $agent_user;
    protected $function_name;
    protected $value_param;

	protected function sendCommand($otherHttpParams)
	{
		$curlURL = "https://213.171.204.244/agent/api.php?";
		$httpParams = array(
			"source" =>BaseGoAutodialRemote::SOURCE,
			"user" =>BaseGoAutodialRemote::USERNAME,
			"pass" =>BaseGoAutodialRemote::PASSWORD,
		);
		$httpParams = array_merge($httpParams, $otherHttpParams);
		$curlURL .= http_build_query($httpParams);
		$curlres = curl_init($curlURL);
		curl_setopt($curlres, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlres, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curlres, CURLOPT_SSL_VERIFYPEER, false);
		$curlResRaw = curl_exec($curlres);
		Yii::log($curlResRaw, CLogger::LEVEL_INFO,'info');
		return $curlResRaw;
	}

    public function setAgentUser($agent_user)
    {
        $this->agent_user = $agent_user;
    }

    public function getAgentUser()
    {
        return $this->agent_user;
    }

    public function setFunctionName($function_name)
    {
        $this->function_name = $function_name;
    }

    public function getFunctionName()
    {
        return $this->function_name;
    }

    public function setValueParam($value_param)
    {
        $this->value_param = $value_param;
    }

    public function getValueParam()
    {
        return $this->value_param;
    }


}