<?php
date_default_timezone_set('America/New_York');

require __DIR__ . '/../vendor/autoload.php';
session_start();

// Instantiate the app
$settings = require __DIR__ . '/../app/settings.php';

$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../app/dependencies.php';

// Register middleware
// require __DIR__ . '/../app/middleware.php';

// Register routes
require __DIR__ . '/../app/routes.php';

// Run!
$app->run();
