<?php
// Routes
$app->get('/', App\Controller\HomePage::class)
    ->setName('homepage');

$app->get('/commit.txt', App\Controller\CommitText::class)
    ->setName('committxt');

$app->get('/{hash}', App\Controller\Commit::class)
    ->setName('commit');
