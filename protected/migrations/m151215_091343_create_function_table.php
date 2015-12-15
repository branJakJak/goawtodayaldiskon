<?php

class m151215_091343_create_function_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("tbl_function",array(
				"id"=>"pk",
				"function_name"=>"string",
				"date_created"=>"datetime",
				"date_updated"=>"datetime",
			));
	}

	public function safeDown()
	{
		$this->dropTable("tbl_function");
	}
}