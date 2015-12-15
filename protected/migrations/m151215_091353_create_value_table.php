<?php

class m151215_091353_create_value_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("tbl_value",array(
				"id"=>"pk",
				"function_name"=>"string",
				"date_created"=>"datetime",
				"date_updated"=>"datetime",
			));
	}

	public function safeDown()
	{
		$this->dropTable("tbl_value");
	}

}