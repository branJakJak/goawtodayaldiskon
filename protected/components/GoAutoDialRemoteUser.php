<?php 
/**
* RemoteUser
*/
class GoAutoDialRemoteUser
{
	public function getAll()
	{
		$sqlCommand = "select * from vicidial_live_agents";
		$command = Yii::app()->goautodial_db->createCommand($sqlCommand);
		return $sqlCommand->queryAll();
	}
}