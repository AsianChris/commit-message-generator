<?php
// DIC configuration
$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
    return $view;
};

// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['logger']['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------
$container[App\Controller\HomePage::class] = function ($c) use ($app) {
    return new App\Controller\HomePage($app, $c->get('view'), $c->get('logger'));
};

$container[App\Controller\MessageText::class] = function ($c) use ($app)  {
    return new App\Controller\MessageText($app, $c->get('view'), $c->get('logger'));
};

$container[App\Controller\Message::class] = function ($c) use ($app)  {
    return new App\Controller\Message($app, $c->get('view'), $c->get('logger'));
};

$container['notFoundHandler'] = function ($c) {
    return new App\Controller\NotFoundHandler($c->get('view'), function ($request, $response) use ($c) {
        return $c['response']->withStatus(404);
    });
};
