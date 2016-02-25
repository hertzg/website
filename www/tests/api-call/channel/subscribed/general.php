#!/usr/bin/php
<?php

include_once '../../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../../fns/get_main_engine.php';
$engine = get_main_engine();

include_once '../../fns/get_sender_engine.php';
$senderEngine = get_sender_engine();

$channel_name = 'sample-name';
$receive_notifications = true;

$response = $senderEngine->request('channel/add', [
    'channel_name' => $channel_name,
]);
$senderEngine->expectSuccess();
$senderEngine->expectNatural('', $response);

$channel_id = $response;

$response = $engine->request('channel/subscribed/subscribe', [
    'channel_name' => $channel_name,
]);
$engine->expectError('CHANNEL_NOT_PUBLIC');

$response = $senderEngine->request('channel/edit', [
    'id' => $channel_id,
    'channel_name' => $channel_name,
    'public' => true,
]);
$senderEngine->expectSuccess();
$senderEngine->expectValue('', true, $response);

$response = $engine->request('channel/subscribed/subscribe', [
    'channel_name' => $channel_name,
    'receive_notifications' => $receive_notifications,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('channel/subscribed/get', [
    'id' => $id,
]);
$engine->expectSuccess();
include_once 'fns/expect_subscribed_channel_object.php';
expect_subscribed_channel_object($engine, '', $response);
$engine->expectValue('.channel_name', $channel_name, $response->channel_name);
$engine->expectValue('.channel_public', true, $response->channel_public);
$engine->expectValue('.id', $id, $response->id);
$engine->expectValue('.received_notification',
    $receive_notifications, $response->receive_notifications);

$response = $engine->request('channel/subscribed/list', []);
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $subscribed_channel) {
    expect_subscribed_channel_object($engine, "[$i]", $subscribed_channel);
}

$response = $engine->request('channel/subscribed/unsubscribe', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('channel/subscribed/unsubscribe', [
    'id' => $id,
]);
$engine->expectError('SUBSCRIBED_CHANNEL_NOT_FOUND');

$response = $senderEngine->request('channel/delete', [
    'id' => $channel_id,
]);
$senderEngine->expectSuccess();
$senderEngine->expectValue('', true, $response);

$numRequests = $engine->numRequests + $senderEngine->numRequests;
echo 'Done '.__FILE__."\n $numRequests requests made.\n";
