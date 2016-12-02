<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;


// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();


$app->register(new Silex\Provider\DoctrineServiceProvider());

$app['sql.DAO'] = $app->share(function ($app) {
   // return new Manager\DAO\EmotionDAO($app['db']);
	return new Manager\DAO\sqlDAO($app['db']);

});