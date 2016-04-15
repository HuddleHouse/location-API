<?php

use Symfony\Component\HttpFoundation\Response;

$login = $app['controllers_factory'];

$login->get('/', function () use ($app) {
    $username = $app['request']->server->get('PHP_AUTH_USER', false);
    $password = $app['request']->server->get('PHP_AUTH_PW');

    if ('igor' === $username && 'password' === $password) {
        $app['session']->set('user', array('username' => $username));
        return $app->redirect('/account');
    }

    $response = new Response();
    $response->headers->set('WWW-Authenticate', sprintf('Basic realm="%s"', 'site_login'));
    $response->setStatusCode(401, 'Please sign in.');
    return $response;
});

$login->get('/account', function () use ($app) {
    if (null === $user = $app['session']->get('user')) {
        return $app->redirect('/login');
    }

    return "Welcome {$user['username']}!";
});

$login->get('/logout', function () use ($app) {
    $username = $app['request']->server->remove('PHP_AUTH_USER');
    $password = $app['request']->server->remove('PHP_AUTH_PW');
    return $app->redirect('/login');
});

return $login;