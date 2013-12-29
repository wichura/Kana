<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
  'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
  'name' => 'My Console Application',
    // application components
  'components' => array(
   'matadb' => array(
    'class' => 'system.db.CDbConnection',
    'connectionString' => 'mysql:host=83.170.88.249;dbname=yii-app-mata-template',
    'emulatePrepare' => true,
    'username' => 'yiimataapptempla',
    'password' => 'CHcxjvLs',
    'charset' => 'utf8',
    'enableParamLogging' => true
    ),
   ),
  'commandMap'=>array(
   'migrate'=>array(
     'class'=>'system.cli.commands.MigrateCommand',
     'migrationPath'=>'application.migrations',
     'migrationTable'=>'matainstallationmigration',
     'connectionID'=>'matadb',
     'interactive'=> 0,
     'templateFile'=>'application.migrations.template',
     )
   ),
  'modules' => array(
    'user' => array(
            # encrypting method (php hash function)
      'hash' => 'md5',
            # send activation email
      'sendActivationMail' => true,
            # allow access for non-activated users
      'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
      'activeAfterRegister' => false,
            # automatically login from registration
      'autoLogin' => true,
            # registration path
      'registrationUrl' => array('/user/registration'),
            # recovery password path
      'recoveryUrl' => array('/user/recovery'),
            # login form path
      'loginUrl' => array('/user/login'),
            # page after login
      'returnUrl' => array('/user/profile'),
            # page after logout
      'returnLogoutUrl' => array('/user/login'),
      'tableUsers' => "user",
      "tableProfiles" => "userprofile",
      "tableProfileFields" => "userprofilefield"
      ),
    )
  );