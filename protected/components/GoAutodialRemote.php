<?php


class GoAutodialRemote {
	const USERNAME = "itsupport";
	const PASSWORD = "mad4itnow2015";
	const SOURCE = "RECONT";

	public function pause($agent_user , $function_param="external_pause" ,$value_param="PAUSE")
	{
		$otherParams = array(
			"agent_user" =>$agent_user,
			"function" =>$function_param,
			"value" =>$value_param
		);
		return $this->send($otherParams);
	}
	public function changePauseCode($agent_user , $function_param="pause_code" ,$value_param="BRK")
	{
		$otherParams = array(
			"agent_user" =>$agent_user,
			"function" =>$function_param,
			"value" =>$value_param
		);
		return $this->send($otherParams);
		
	}

    /**
     *
     * @param $agent
     * @return string
     * @throws Exception
     */
    public function logout($agent)
    {
    	$otherParams = array(
    			"agent_user"=>$agent,
    			"function"=>"logout",
    			"value"=>"LOGOUT",
    		);
    	return $this->send($otherParams);
    }

    /**
     * 
     */
    public function logoutAll()
    {
    	$otherParams = array(
    			"function"=>"logout_all",
    			"value"=>"LOGOUT"
    		);
    	return $this->send($otherParams);
    }

	protected function send($otherHttpParams)
	{
		$curlURL = "https://213.171.204.244/agent/api.php?";
		$httpParams = array(
			"source" =>GoAutodialRemote::SOURCE,
			"user" =>GoAutodialRemote::USERNAME,
			"pass" =>GoAutodialRemote::PASSWORD,
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
}