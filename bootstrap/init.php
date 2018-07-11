<?php
require __DIR__."/../vendor/autoload.php";

use harpya\ufw\Application;

$request = \harpya\ufw\Request::of();

$app = Application::getInstance([
    Application::DEF_APPS_PATH => '../apps/',
    Application::CMP_ROUTER => new harpya\ufw\Router(),
    Application::CMP_REQUEST => $request,
    Application::CMP_CONFIG => \harpya\ufw\Config::of(__DIR__.'/../config'),
    Application::CMP_VIEW => \harpya\ufw\view\Smarty::getInstance(),
    Application::CMP_DEBUG => 1,
    Application::CMP_SESSION =>  \harpya\ufw\Session::getInstance()->init()
]);


$app->init();

$app->run();
