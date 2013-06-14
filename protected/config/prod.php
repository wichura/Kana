<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Mata CMS',
    'language' => 'pl',
    'sourceLanguage' => "en",
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.base.*',
        'application.controllers.*',
        'application.models.*',
        'application.components.*',
        'application.helpers.*'
    ),
    'modules' => array(
       'user' => array(
            'class' => "application.modules.user.UserModule",
            'hash' => 'sha1',
            'sendActivationMail' => false,
            'activeAfterRegister' => true,
            'autoLogin' => false,
            'tableUsers' => "user",
            "tableProfiles" => "userprofile",
            "tableProfileFields" => "userprofilefield",
            'returnUrl' => "/",
            'captcha' => array('registration' => false)
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'dev',
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        "touchstone" => array(
            "active" => false
        ),
        'client',
        'contentBlock',
        'project' => array(
            "class" => "application.modules.project.ProjectModule",
        )
    ),
    'components' => array(
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'matadb' => array(
            'connectionString' => 'mysql:host=83.170.88.249;dbname=kana',
            'emulatePrepare' => true,
            'username' => 'kana',
            'password' => '1fDx2cG7DsXhupqyC61',
            'charset' => 'utf8',
            'enableParamLogging' => true
        ),
        'db' => array(
            'connectionString' => 'mysql:host=83.170.88.249;dbname=kana',
            'emulatePrepare' => true,
            'username' => 'kana',
            'password' => '1fDx2cG7DsXhupqyC61',
            'charset' => 'utf8',
            'enableParamLogging' => true
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
    // this is used in contact page
    ),
);