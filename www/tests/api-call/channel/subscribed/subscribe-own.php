#!/usr/bin/php
<?php

include_once '../../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../../fns/get_main_engine.php';
$engine = get_main_engine();

$channel_name = 'sample-name';

$response = $engine->request('channel/add', [
    'channel_name' => $channel_name,
    'public' => true,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('channel/subscribed/subscribe', [
    'channel_name' => $channel_name,
]);
$engine->expectError('CHANNEL_IS_OWN');

$response = $engine->request('channel/delete', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
