<?php

require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\SessionServiceProvider());

require_once __DIR__.'/LocationApi/index.php';
//require_once __DIR__.'/Login/index.php';

$app->mount('/login', include __DIR__ . '/Login/index.php');
$app->mount('/location', include __DIR__ . '/LocationApi/index.php');

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

$app->run();
