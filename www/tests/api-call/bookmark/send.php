#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$selfUsername = 'aimnadze';
$nonExistingUsername = 'non-existing-username';
$deniedUsername = 'giorgi';
$allowedUsername = 'angeli';
$url = 'sample url';

$response = $engine->request('bookmark/send', [
    'receiver_username' => $selfUsername,
]);
$engine->expectError('SENDING_TO_SELF');

$response = $engine->request('bookmark/send', [
    'receiver_username' => $nonExistingUsername,
]);
$engine->expectError('RECEIVER_NOT_FOUND');

$response = $engine->request('bookmark/send', [
    'receiver_username' => $deniedUsername,
]);
$engine->expectError('RECEIVER_NOT_RECEIVING');

$response = $engine->request('bookmark/send', [
    'receiver_username' => $allowedUsername,
    'url' => $url,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
