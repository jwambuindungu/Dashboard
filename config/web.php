<?php

$params = require(__DIR__ . '/params.php');
$dashboard_db = require(__DIR__ . '/dashboard_db.php');
$muthoni_orcl = require(__DIR__ . '/muthoni_db.php');
$online_app_db = require(__DIR__ . '/online_app_db.php');
$hr_db = require(__DIR__ . '/hr_db.php');
$uspas_db = require(__DIR__ . '/uspas_db.php');
$rgmis_db = require(__DIR__ . '/rgmis_db.php');
$transmis_db = require(__DIR__ . '/transmis_db.php');

$config = [
    'id' => 'basic',
    'name' => 'UON Management Dashboard',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => 'vendor/bower-asset',
    ],
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module'
        ],
        'student' => [
            'class' => 'app\modules\student\student',
            'defaultRoute' => 'student', //default controller
        ],

        'staff' => [
            'class' => 'app\modules\staff\staff',
            'defaultRoute' => 'staff', //default controller
        ],
        // call to the uspas module
        'uspas' => [
            'class' => 'app\modules\uspas\uspas',
            'defaultRoute' => 'uspas', //default controller
        ],
        // call to the rgmis module
        'rgmis' => [
            'class' => 'app\modules\rgmis\rgmis',
            'defaultRoute' => 'rgmis', //default controller
        ],
        // call to the transmis module
        'transmis' => [
            'class' => 'app\modules\transmis\transmis',
            'defaultRoute' => 'transmis', //default controller
        ],
		 // call to the smis module
        'smis' => [
            'class' => 'app\modules\smis\smis',
            'defaultRoute' => 'smis', //default controller
        ],
        // call to the website module
        'website' => [
            'class' => 'app\modules\website\website',
            'defaultRoute' => 'website', //default controller
        ],
    ],
    'components' => [
        /* custom view template*/
        'view' => [
            'theme' => [
                'pathMap' => [
                    //'@app/views' => 'themes/sbadmin/views',
                    '@app/views' => 'themes/adminlte/views',
                    //'@app/modules' => 'themes/adminlte/views'
                ],
                //'baseUrl' => 'themes/bootstrap' /* base url */
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'NLnWzghzXD2wLzpAzjvrsPC13oL5ViGA',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\DASHBOARD_USERS',
            'enableAutoLogin' => true,
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'timeout' => 60 * 5, //5 minutes //60 * 60 * 24 * 7, // 1 week
            'sessionTable' => 'YII_SESSION',
            'writeCallback' => function ($session) {
                return [
                    'user_id' => isset(Yii::$app->user->id) ? Yii::$app->user->id : 'guest user',
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'is_trusted' => $session->get('is_trusted', false),
                ];
            }
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $dashboard_db,
        'muthoni_orcl' => $muthoni_orcl,
        'onlineapp' => $online_app_db,
        'hr_db' => $hr_db,
        'rgmis_db' => $rgmis_db,
        'uspas_db' => $uspas_db,// call to the db connection
        'transmis_db' => $transmis_db,// call to the db connection
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
                'dashboard' => 'site/index',
                'dashboard-admin' => 'dashboard/index',

                //SMIS
                'smis-dashboard' => 'student/student/dashboard',
                'student-reports' => 'student/student/application',
                'intake-stats' => 'student/student/application', //get intakes count for each intake
                'col-details' => 'student/intake/college-detail', //get college count for each intake
                'intake-details' => 'student/intake/intake-detail', //get program count for each intake
                'prog-details' => 'student/intake/prog-detail', //show appliants in the programme
                'fee-collection' => 'student/fee/fee-collection', //show appliants in the programme
                'nominal-roll' => 'student/nominal/nominal-roll', //show appliants in the programme
                'nominal-year' => 'student/nominal/nominal-year', //show appliants in the programme
                'foreign_students' => 'smis/smis/foreign_students', //show appliants in the programme

                //USPAS
                'uspas' => 'uspas/uspas',
				
				//SMIS
                'smis' => 'smis/smis',
				
				
				//TRANSMIS
                'transmis' => 'transmis/transmis',
                'repair-costs' => 'transmis/transmis/repaircosts',
				'annual-repair-costs' => 'transmis/transmis/annualrepaircosts',

                //HR
                'staff-reports' => 'staff/dashboard',
                'finance-reports' => 'staff/dashboard/finance',
                'staffing' => 'staff/staff/collegestaff',
                'control-summary' => 'staff/staff/controlsummary',
                'budget' => 'staff/staff/budget',
                'age' => 'staff/staff/collegeage',
                'leave' => 'staff/staff/staff-on-leave',

                //Website
                'webometric-report' => 'website/website',

            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '41.89.65.170'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '41.89.65.170'],
    ];
}

return $config;
