<?php


class GoAutodialRemote {
	const USERNAME = "itsupport";
	const PASSWORD = "mad4itnow2015";
	const SOURCE = "RECONT";
	public function send($agent_user , $function_param="external_pause" ,$value_param="PAUSE")
	{
		$curlURL = "https://213.171.204.244/agent/api.php?";
		$httpParams = array(
			"source" =>GoAutodialRemote::SOURCE,
			"user" =>GoAutodialRemote::USERNAME,
			"pass" =>GoAutodialRemote::PASSWORD,
			"agent_user" =>$agent_user,
			"function" =>$function_param,
			"value" =>$value_param
		);
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