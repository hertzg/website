#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('channel/add', [
    'channel_name' => 'sample-channel-name',
    'public' => false,
    'receive_notifications' => false,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('channel/edit', [
    'id' => $id,
    'channel_name' => 'invalid channel name',
    'public' => true,
    'receive_notifications' => true,
]);
$engine->expectError('INVALID_CHANNEL_NAME');

$response = $engine->request('channel/edit', [
    'id' => $id,
    'channel_name' => 'short',
    'public' => true,
    'receive_notifications' => true,
]);
$engine->expectError('CHANNEL_NAME_TOO_SHORT');

$channel_name = 'edit-channel-name';
$public = true;
$receive_notifications = true;

$response = $engine->request('channel/edit', [
    'id' => $id,
    'channel_name' => $channel_name,
    'public' => $public,
    'receive_notifications' => $receive_notifications,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

include_once 'fns/expect_channel_object.php';
$response = $engine->request('channel/get', ['id' => $id]);
$engine->expectSuccess();
expect_channel_object($engine, '', $response);
$engine->expectValue('.channel_name',
    $channel_name, $response->channel_name);
$engine->expectValue('.public', $public, $response->public);
$engine->expectValue('.receive_notifications',
    $receive_notifications, $response->receive_notifications);

$response = $engine->request('channel/delete', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
