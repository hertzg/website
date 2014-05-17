#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$nonExistingUsername = 'non-existing-username';
$deniedUsername = 'giorgi';
$allowedUsername = 'angeli';
$full_name = 'sample full_name';

$response = $engine->request('contact/send', [
    'receiver_username' => $nonExistingUsername,
]);
$engine->expectError('RECEIVER_NOT_FOUND');

$response = $engine->request('contact/send', [
    'receiver_username' => $deniedUsername,
]);
$engine->expectError('RECEIVER_NOT_RECEIVING');

$response = $engine->request('contact/send', [
    'receiver_username' => $allowedUsername,
    'full_name' => $full_name,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
