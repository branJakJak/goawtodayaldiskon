<?php 
/**
* RemoteUser
*/
class GoAutoDialRemoteUser
{
	public function getAll()
	{
<<<<<<< HEAD
		// $curlURL = "http://213.171.204.244/listagents.php";
		$result = Yii::app()->asterisk_db->createCommand(" select * from agent_live_stats")->queryAll();
		return $result;
		// $curlURL = "http://149.202.73.207/listagents.php";
		// $curlres = curl_init($curlURL);
		// curl_setopt($curlres, CURLOPT_RETURNTRANSFER, true);
		// $curlResRaw = curl_exec($curlres);
		// return json_decode($curlResRaw, true);
=======
		$curlURL = "http://213.171.204.244/listagents_view.php";
		$curlres = curl_init($curlURL);
		curl_setopt($curlres, CURLOPT_RETURNTRANSFER, true);
		$curlResRaw = curl_exec($curlres);
		return json_decode($curlResRaw, true);
>>>>>>> db00ed89bbf99a099afe102ed7aa40554b1e8433
	}
}