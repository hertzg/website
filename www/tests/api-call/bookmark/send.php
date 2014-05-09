#!/usr/bin/php
<?php

include_once '../classes/Engine.php';
$engine = new Engine;

$nonExistingUsername = 'non-existing-username';
$deniedUsername = 'giorgi';
$allowedUsername = 'angeli';
$sent_bookmark_url = 'sent bookmark url';
$sent_bookmark_title = 'sent bookmark title';

$response = $engine->request('bookmark/send');
$engine->expectError('ENTER_RECEIVER_USERNAME');

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
    'url' => $sent_bookmark_url,
    'title' => $sent_bookmark_title,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

echo "Done\n";
echo "$engine->numRequests requests made.\n";
