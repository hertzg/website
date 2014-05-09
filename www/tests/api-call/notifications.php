#!/usr/bin/php
<?php

chdir(__DIR__);

include_once 'classes/Engine.php';
$engine = new Engine;

$channel_name = 'test-channel-name';

$response = $engine->request('channel/add', [
    'channel_name' => $channel_name,
    'receive_notifications' => true,
]);
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('notification/post');
$engine->expectError('CHANNEL_NOT_FOUND');

$response = $engine->request('notification/post', [
    'channel_name' => $channel_name,
]);
$engine->expectError('ENTER_NOTIFICATION_TEXT');

$response = $engine->request('notification/post', [
    'channel_name' => $channel_name,
    'notification text' => 'notification text',
]);
$engine->expectValue('', true, $response);

$response = $engine->request('notification/deleteAll');
$engine->expectValue('', true, $response);

$response = $engine->request('channel/delete', [
    'id' => $id,
]);
$engine->expectValue('', true, $response);

echo "Done\n";
echo "$engine->numRequests requests made.\n";
