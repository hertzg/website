#!/usr/bin/php
<?php

function expect_channel_object ($engine, $variableName, $channel) {
    $properties = ['id', 'channel_name', 'public', 'insert_time'];
    $engine->expectObject($variableName, $properties, $channel);
    $engine->expectNatural("$variableName.id", $channel->id);
    $engine->expectType("$variableName.channel_name", 'string', $channel->channel_name);
    $engine->expectType("$variableName.public", 'boolean', $channel->public);
    $engine->expectNatural("$variableName.insert_time", $channel->insert_time);
}

$new_channel_channel_name = 'new-channel-name';
$new_channel_public = true;

$edited_channel_channel_name = 'new-channel-name';
$edited_channel_public = false;

$invalidChannelName = 'invalid channel name';

include_once 'classes/Engine.php';
$engine = new Engine;

$response = $engine->request('channel/add');
$engine->expectStatus(400);
$engine->expectValue('', 'ENTER_CHANNEL_NAME', $response);

$response = $engine->request('channel/add', [
    'channel_name' => $invalidChannelName,
    'public' => $new_channel_public,
]);
$engine->expectStatus(400);
$engine->expectValue('', 'INVALID_CHANNEL_NAME', $response);

$response = $engine->request('channel/add', [
    'channel_name' => $new_channel_channel_name,
    'public' => $new_channel_public,
]);
$engine->expectStatus(200);
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('channel/add', [
    'channel_name' => $new_channel_channel_name,
    'public' => $new_channel_public,
]);
$engine->expectStatus(400);
$engine->expectValue('', 'CHANNEL_ALREADY_EXISTS', $response);

$channels = $engine->request('channel/list');
$engine->expectStatus(200);
$engine->expectType('', 'array', $channels);
foreach ($channels as $i => $channel) {
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
$engine->expectStatus(400);
$engine->expectValue('', 'CHANNEL_NOT_FOUND', $response);

echo "Done\n";
echo "$engine->numRequests requests made.\n";
