<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Ярмарка',
    'sourceLanguage' => 'en',
    'language' => 'ru',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'dmitxe',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
		//	'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

    'behaviors'=>array(
          'ext.yii-less.components.LessCompilationBehavior',
    ),
    // application components
	'components'=>array(
              'lessCompiler'=>array(
              'class'=>'ext.yii-less.components.LessCompiler',
              'paths'=>array(
          // you can access to the compiled file on this path
                    '/css/bootstrap.css' => array(
                     'precompile' => true, // whether you want to cache the generation
                     'paths' => array('/less/bootstrap.less') //paths of less files. you can specify multiple files.
                 ),
               ),
               ),
    'viewRenderer' => array(
        'class' => 'ext.ETwigViewRenderer',

        // Все параметры ниже являются необязательными
        'fileExtension' => '.twig',
        'options' => array(
            'autoescape' => true,
        ),
 
    ),            
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
                            'sitemap.xml'=>'site/sitemapxml'
/*				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',*/
			),
                     "showScriptName"=>false,
                     "urlSuffix"=>"",
		),
		
/*		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
                        'db'=>array(
                                'connectionString' => 'mysql:host=localhost;port=3306;dbname=market',
            //			'connectionString' => 'mysql:host=u339442.mysql.masterhost.ru;dbname=u339442',
                                'emulatePrepare' => true,
                                'username' => 'root',
                                'password' => 'root',
            //			'username' => 'u339442',
            //			'password' => 'moidoringle64',
                                'charset' => 'utf8',
                                'tablePrefix' => 'sbv_',
                                    // включаем профайлер
                                    'enableProfiling'=>true,
                                    // показываем значения параметров
                                    'enableParamLogging' => true,
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
	'log'=>array(
                    'class'=>'CLogRouter',
                    'enabled'=>YII_DEBUG,
                    'routes'=>array(
                        array(
                        // направляем результаты профайлинга в ProfileLogRoute (отображается
            // внизу страницы)
                           'class'=>'CProfileLogRoute',
                //            'class'=>'CFileLogRoute',
                            'levels'=>'error, warning',
                        ),
 
   /*  'log' => array(
    'class' => 'CLogRouter',
    'routes' => array(
        array(
            'class' => 'CWebLogRoute',
            'categories' => 'application',
            'showInFireBug' => true
        ),
    ),
),*/
/*                        array(
                            'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                            'ipFilters'=>array('127.0.0.1'),
                        ),*/

				// uncomment the following to show log messages on web pages
	array(
	        'class'=>'CWebLogRoute',
                               'categories' => 'application',
                               'showInFireBug' => true
	         ),
				
	      ),
	 ),
               ),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'XeDmitry@yandex.ru',
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);