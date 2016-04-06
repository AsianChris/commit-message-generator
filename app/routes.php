<?php
// Routes
$app->get('/', App\Controller\HomePage::class)
    ->setName('homepage');

$app->get('/{hash}', App\Controller\Commit::class)
    ->setName('commit');
