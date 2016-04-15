<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


$location = $app['controllers_factory'];
$location->get('/save', function () use ($app) {


    return "Welcome username!";
});

$location->post('/feedback', function (Request $request) {
//    $message = $request->get('message');
//    mail('feedback@yoursite.com', '[YourSite] Feedback', $message);

    return new Response('Thank you for your feedback!', 201);
});

return $location;
