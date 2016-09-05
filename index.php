<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
//use slim\App;

error_reporting(E_ALL);
// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1);
require 'vendor/autoload.php';
require 'config/config.php';
require 'config/dbConfig.php';
function controller_autoloader($className) {
    $filename = 'controller/'.$className . ".php";
    if (is_readable($filename)) {
    	//echo $filename;
    	//exit();
        require $filename;

    }
}
function model_autoloader($className) {
    $filename = 'model/'.$className . ".php";
    if (is_readable($filename)) {
    	//echo $filename;
    	//exit();
        require $filename;

    }
}
function dataManager_autoloader($className) {
    $filename = 'dataManager/'.$className . ".php";
    if (is_readable($filename)) {
    	//echo $filename;
    	//exit();
        require $filename;

    }
}
/*
function config_autoloader($className) {
    $filename = 'config/'.$className . ".php";
    if (is_readable($filename)) {
        //echo $filename;
        //exit();
        require $filename;

    }
}*/
spl_autoload_register('controller_autoloader');
spl_autoload_register('model_autoloader');
spl_autoload_register('dataManager_autoloader');
//spl_autoload_register('config_autoloader');
/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */

$app = new \Slim\App();
$common =new controller();
//$app->contentType('application/json');
/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

$app->get('/demo',array($common,'demo'));
$app->get('/getImageList',array($common,'getImageList'));
$app->post('/token/',array($common,'token'));
$app->get('/companyDetails',array($common,'companyDetails'));
$app->get('/getBizInfo',array($common,'getBizInfo'));

// GET route
/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
