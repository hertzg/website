#!/usr/bin/php
<?php

chdir(__DIR__);

include_once 'fns/expect_channel_object.php';

$new_channel_name = 'new-channel-name';
$new_public = true;
$new_receive_notifications = true;

include_once '../classes/Engine.php';
$engine = new Engine;

$response = $engine->request('channel/add', [
    'channel_name' => 'invalid channel name',
    'public' => $new_public,
    'receive_notifications' => $new_receive_notifications,
]);
$engine->expectError('INVALID_CHANNEL_NAME');

$response = $engine->request('channel/add', [
    'channel_name' => 'short',
    'public' => $new_public,
    'receive_notifications' => $new_receive_notifications,
]);
$engine->expectError('CHANNEL_NAME_TOO_SHORT');

$response = $engine->request('channel/add', [
    'channel_name' => $new_channel_name,
    'public' => $new_public,
    'receive_notifications' => $new_receive_notifications,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('channel/add', [
    'channel_name' => $new_channel_name,
    'public' => $new_public,
    'receive_notifications' => $new_receive_notifications,
]);
$engine->expectError('CHANNEL_ALREADY_EXISTS');

$response = $engine->request('channel/get', ['id' => $id]);
$engine->expectSuccess();
expect_channel_object($engine, '', $response);
$engine->expectValue('.channel_name',
    $new_channel_name, $response->channel_name);
$engine->expectValue('.public', $new_public, $response->public);
$engine->expectValue('.receive_notifications',
    $new_receive_notifications, $response->receive_notifications);
$engine->expectNatural('.insert_time', $response->insert_time);
$engine->expectNatural('.update_time', $response->update_time);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('channel/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $channel) {
    expect_channel_object($engine, ".[$i]", $channel);
}

$response = $engine->request('channel/delete', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('channel/delete', [
    'id' => $id,
]);
$engine->expectError('CHANNEL_NOT_FOUND');

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
