<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'My Console Application',
	'import' => array(
		'ext.YiiMailer.YiiMailer',
	),
	// application components
	'components' => array(

        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=roadto_agentmon',
            'emulatePrepare' => true,
            'username' => 'roadto_agentmon',
            'password' => 'hitman052529',
            'charset' => 'utf8',  
        ),
	),
	'modules'=>array(
        'user'=>array(
                'tableUsers' => 'users',
                'tableProfiles' => 'profiles',
                'tableProfileFields' => 'profiles_fields',
        ),
	)
);
