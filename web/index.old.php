<?php

require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Entity\Location;

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new \Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array (
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'location_api',
            'user' => 'location_api',
            'password' => 'location_api',
            'charset'   => 'utf8mb4',
    ),
    ));

$app->get('/location/save', function () use ($app) {
    return new Response("Error: call POST instead of GET.", 401);
});

$app->put('/location/save', function (Request $request) use ($app) {
    $lat = $request->get('lat');
    $lon = $request->get('lon');
    $email = $request->get('email');
    $time = $request->get('time');

    try {
        $location = new Location();
        $location->setLat($lat);
        $location->setLon($lon);
        $location->setEmail($email);

        if($time)
            $location->setTime($time);
        else
            $location->setTime(date('Y-m-d'));

//        $sql = "insert into locations (lat, lon, email, time) values (?, ?, ?, ?)";
        $app['db.orm.em']->persist($location);
        $app['db.orm.em']->flush();
//        $location['db']['localhost']->executeUpdate($sql, array($lat, $lon, $email, $time));
    }
    catch (Exception $e) {
        return 'Error: ' . $e->getMessage() ."\n";
    }

    return new Response('Success!', 201);
});

$app->get('/hello/{name}', function ($name) use ($app) {
    $i = 1;
    return 'Hello '.$app->escape($name);
});

$app->run();
