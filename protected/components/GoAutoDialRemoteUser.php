<?php 
/**
* RemoteUser
*/
class GoAutoDialRemoteUser
{
	public function getAll()
	{
		$result = Yii::app()->asterisk_db->createCommand(" select * from agent_live_stats")->queryAll();
		return $result;
	}
}

