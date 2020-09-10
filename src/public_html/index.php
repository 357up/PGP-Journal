<?php

/**
 * A simple PHP Login Script / ADVANCED VERSION
 * For more versions (one-file, minimal, framework-like) visit http://www.php-login.net
 *
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login-advanced/
 * @license http://opensource.org/licenses/MIT MIT License
 */

/**
 * Determine wether or not the application is installed in document root or a subdirectory
 */
define('APP_CONTEXT', str_replace($_SERVER['DOCUMENT_ROOT'], "", __DIR__));

//ini_set("log_errors", 1);
//ini_set("error_log", sys_get_temp_dir() . "/php-error.log");
//error_log( "Start Session" );

// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once(__DIR__.'/../app/libraries/password_compatibility_library.php');
}
// include the config
require_once(__DIR__.'/../app/config/config.php');

if (preg_match("#^".APP_CONTEXT."/+edit/*(\?|$)#i", $_SERVER['REQUEST_URI'])) {
	include __DIR__.'/../app/edit.php';
	exit(0);
}
if (preg_match("#^".APP_CONTEXT."/+password_reset/*(\?|$)#i", $_SERVER['REQUEST_URI'])) {
	include __DIR__.'/../app/password_reset.php';
	exit(0);
}
if (preg_match("#^".APP_CONTEXT."/+register/*(\?|$)#i", $_SERVER['REQUEST_URI'])) {
	include __DIR__.'/../app/register.php';
	exit(0);
}
if (preg_match("#^".APP_CONTEXT."/+show_captcha/*(\?|$)#i", $_SERVER['REQUEST_URI'])) {
	include __DIR__.'/../app/tools/showCaptcha.php';
	exit(0);
}

header('Cache-Control: max-age=900');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once(__DIR__.'/../app/translations/en.php');

// include the PHPMailer library
require_once(__DIR__.'/../app/libraries/PHPMailer.php');

// load the login class
require_once(__DIR__.'/../app/classes/Login.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();



// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    include(__DIR__.'/../app/views/logged_in.php');

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include(__DIR__.'/../app/views/not_logged_in.php');
}
