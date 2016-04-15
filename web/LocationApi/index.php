<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


$location = $app['controllers_factory'];

$location->get('/save', function () use ($app) {
    return new Response("Error: call POST instead of GET.", 401);
});

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'dbname'    => 'location_api',
        'user'      => 'location_api',
        'password'  => 'location_api',
        'charset'   => 'utf8mb4',
    ),
));

$location->post('/save', function (Request $request) {
    $lat = $request->get('lat');
    $lon = $request->get('lon');
    $email = $request->get('email');
    $time = $request->get('time');

    try {
        $sql = "insert into locations (lat, lon, email, time) values (?, ?, ?, ?)";

        $location['db']['localhost']->executeUpdate($sql, array($lat, $lon, $email, $time));

    }
    catch (Exception $e) {
        return 'Error: ' . $e->getMessage() ."\n";
    }

    return new Response('Success!', 201);
});

return $location;
