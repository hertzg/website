#!/usr/bin/php
<?php

include_once 'classes/Engine.php';
$engine = new Engine;

$channel_name = 'test-channel-name';

$response = $engine->request('channel/add', [
    'channel_name' => $channel_name,
]);

$engine->request('channel/delete', [
    'id' => $response,
]);

echo "Done\n";
echo "$engine->numRequests requests made.\n";
