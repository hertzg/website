#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$channel_name = 'test-channel-name';

$response = $engine->request('channel/add', [
    'channel_name' => $channel_name,
    'receive_notifications' => true,
]);
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('notification/post', [
    'channel_name' => $channel_name,
]);
$engine->expectError('ENTER_TEXT');

$response = $engine->request('notification/post', [
    'channel_name' => $channel_name,
    'text' => 'text',
]);
$engine->expectValue('', true, $response);

$response = $engine->request('notification/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $notification) {
    $properties = ['id', 'text', 'channel_name', 'insert_time'];
    $engine->expectObject("[$i]", $properties, $notification);
    $engine->expectType("[$i].text", 'string', $notification->text);
    $engine->expectType("[$i].channel_name",
        'string', $notification->channel_name);
    $engine->expectNatural("[$i].insert_time", $notification->insert_time);
}

$response = $engine->request('notification/deleteAll');
$engine->expectValue('', true, $response);

$response = $engine->request('notification/list');
$engine->expectSuccess();
$engine->expectValue('.length', 0, count($response));

$response = $engine->request('channel/delete', [
    'id' => $id,
]);
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
