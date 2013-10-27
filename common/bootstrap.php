<?php
/**
 * This is the global bootstrap file containing code which should be run for *every* entry point.
 */

// Path to the real root of project
define('ROOT_DIR', realpath(__DIR__ . '/..'));

// Depending on various triggers you can enable debug mode for the project here.
// You can control debug mode with additional Yii console command named `debugmode`: `./yiic debugmode on`
if (file_exists(ROOT_DIR . '/debugmodeon') // enabled via the flag file
    || !empty($_SERVER['YII_DEBUG']) // enabled via the $_SERVER var
    || getenv('YII_DEBUG') // enabled via the environment var
) {
    require_once __DIR__ . '/debugmode.php';
}

// If we have autoloader from Composer, use it.
if (file_exists(ROOT_DIR . '/vendor/autoload.php'))
    require ROOT_DIR . '/vendor/autoload.php';

// NOTE that you must declare `YII_DEBUG` and `YII_TRACE_LEVEL`
// BEFORE loading the framework or it will have no effect on Yii!

// Launching the Yii framework.
require_once ROOT_DIR . '/vendor/yiisoft/yii/framework/YiiBase.php';
// Include our own Yii singleton definition
require_once(ROOT_DIR.'/common/components/Yii.php');
// Include our own base WebApplication class
require_once(ROOT_DIR.'/common/components/WebApplication.php');
// Include our own helper methods library
require_once(ROOT_DIR.'/common/lib/global.php');

// Yes, we "want to append additional autoloaders to the default Yii autoloader".
YiiBase::$enableIncludePath = false;

// Some global aliases
Yii::setPathOfAlias('root', ROOT_DIR);
Yii::setPathOfAlias('common', ROOT_DIR . '/common');

// Global timezone setting
date_default_timezone_set('UTC');

// Set the internal character encoding
mb_internal_encoding("UTF-8");

// We're in XXI century, muthafucka!
setlocale(
    LC_CTYPE,
    'C.UTF-8', // libc >= 2.13
    'C.utf8', // different spelling
    'en_US.UTF-8', // fallback to lowest common denominator
    'en_US.utf8' // different spelling for fallback
);

// PWD will be the root dir of the project
chdir(ROOT_DIR);