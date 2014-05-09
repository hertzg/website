#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$nonExistingUsername = 'non-existing-username';
$deniedUsername = 'giorgi';
$allowedUsername = 'angeli';
$sent_task_text = 'sent task text';

$response = $engine->request('task/send');
$engine->expectError('ENTER_RECEIVER_USERNAME');

$response = $engine->request('task/send', [
    'receiver_username' => $nonExistingUsername,
]);
$engine->expectError('RECEIVER_NOT_FOUND');

$response = $engine->request('task/send', [
    'receiver_username' => $deniedUsername,
]);
$engine->expectError('RECEIVER_NOT_RECEIVING');

$response = $engine->request('task/send', [
    'receiver_username' => $allowedUsername,
    'text' => $sent_task_text,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

echo "Done\n";
echo "$engine->numRequests requests made.\n";
