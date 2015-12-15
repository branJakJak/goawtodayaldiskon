<?php

$yii=dirname(__FILE__).'/protected/framework/yiit.php';
$config=dirname(__FILE__).'/protected/config/main.php';


require_once($yii);
Yii::createWebApplication($config)->run();
