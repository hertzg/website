#!/usr/bin/php
<?php

function expect_channel_object ($engine, $variableName, $channel) {
    $properties = ['id', 'channel_name', 'public', 'receive_notifications', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $channel);
    $engine->expectNatural("$variableName.id", $channel->id);
    $engine->expectType("$variableName.channel_name", 'string', $channel->channel_name);
    $engine->expectType("$variableName.public", 'boolean', $channel->public);
    $engine->expectType("$variableName.receive_notifications", 'boolean', $channel->receive_notifications);
    $engine->expectNatural("$variableName.insert_time", $channel->insert_time);
    $engine->expectNatural("$variableName.update_time", $channel->update_time);
}

$new_channel_channel_name = 'new-channel-name';
$new_channel_public = true;
$new_channel_receive_notifications = true;

$edited_channel_channel_name = 'new-channel-name';
$edited_channel_public = false;
$edited_channel_receive_notifications = false;

$shortChannelName = 'short';
$invalidChannelName = 'invalid channel name';

include_once 'classes/Engine.php';
$engine = new Engine;

$response = $engine->request('channel/add');
$engine->expectError('ENTER_CHANNEL_NAME');

$response = $engine->request('channel/add', [
    'channel_name' => $invalidChannelName,
    'public' => $new_channel_public,
    'receive_notifications' => $new_channel_receive_notifications,
]);
$engine->expectError('INVALID_CHANNEL_NAME');

$response = $engine->request('channel/add', [
    'channel_name' => $shortChannelName,
    'public' => $new_channel_public,
    'receive_notifications' => $new_channel_receive_notifications,
]);
$engine->expectError('CHANNEL_NAME_TOO_SHORT');

$response = $engine->request('channel/add', [
    'channel_name' => $new_channel_channel_name,
    'public' => $new_channel_public,
    'receive_notifications' => $new_channel_receive_notifications,
]);
$engine->expectStatus(200);
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('channel/add', [
    'channel_name' => $new_channel_channel_name,
    'public' => $new_channel_public,
    'receive_notifications' => $new_channel_receive_notifications,
]);
$engine->expectError('CHANNEL_ALREADY_EXISTS');

$response = $engine->request('channel/get');
$engine->expectError('CHANNEL_NOT_FOUND');

$response = $engine->request('channel/get', ['id' => $id]);
$engine->expectStatus(200);
expect_channel_object($engine, '', $response);
$engine->expectValue('.channel_name',
    $new_channel_channel_name, $response->channel_name);
$engine->expectValue('.public', $new_channel_public, $response->public);
$engine->expectValue('.receive_notifications', $new_channel_receive_notifications, $response->receive_notifications);
$engine->expectNatural('.insert_time', $response->insert_time);
$engine->expectNatural('.update_time', $response->update_time);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('channel/edit');
$engine->expectError('CHANNEL_NOT_FOUND');

$response = $engine->request('channel/edit', [
    'id' => $id,
    'channel_name' => $invalidChannelName,
    'public' => $edited_channel_public,
    'receive_notifications' => $edited_channel_receive_notifications,
]);
$engine->expectError('INVALID_CHANNEL_NAME');

$response = $engine->request('channel/edit', [
    'id' => $id,
    'channel_name' => $shortChannelName,
    'public' => $edited_channel_public,
    'receive_notifications' => $edited_channel_receive_notifications,
]);
$engine->expectError('CHANNEL_NAME_TOO_SHORT');

$response = $engine->request('channel/edit', [
    'id' => $id,
    'channel_name' => $edited_channel_channel_name,
    'public' => $edited_channel_public,
    'receive_notifications' => $edited_channel_receive_notifications,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('channel/get', ['id' => $id]);
$engine->expectStatus(200);
expect_channel_object($engine, '', $response);
$engine->expectValue('.channel_name',
    $edited_channel_channel_name, $response->channel_name);
$engine->expectValue('.public', $edited_channel_public, $response->public);
$engine->expectValue('.receive_notifications', $edited_channel_receive_notifications, $response->receive_notifications);
$engine->expectNatural('.insert_time', $response->insert_time);
$engine->expectNatural('.update_time', $response->update_time);

$response = $engine->request('channel/list');
$engine->expectStatus(200);
$engine->expectType('', 'array', $response);
foreach ($response as $i => $channel) {
    expect_channel_object($engine, ".[$i]", $channel);
}

$response = $engine->request('channel/delete', [
    'id' => $id,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('channel/delete', [
    'id' => $id,
]);
$engine->expectError('CHANNEL_NOT_FOUND');

echo "Done\n";
echo "$engine->numRequests requests made.\n";
