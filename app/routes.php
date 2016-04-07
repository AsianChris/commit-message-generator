<?php
// Routes
$app->get('/', App\Controller\HomePage::class)
    ->setName('homepage');

$app->get('/commit-message.txt', App\Controller\MessageText::class)
    ->setName('messagetxt');

$app->get('/{hash}', App\Controller\Message::class)
    ->setName('message');
