#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('channel/add');
$engine->expectError('ENTER_CHANNEL_NAME');

$response = $engine->request('channel/edit');
$engine->expectError('CHANNEL_NOT_FOUND');

$response = $engine->request('channel/get');
$engine->expectError('CHANNEL_NOT_FOUND');

$response = $engine->request('channel/user/add');
$engine->expectError('CHANNEL_NOT_FOUND');

$response = $engine->request('channel/user/list');
$engine->expectError('CHANNEL_NOT_FOUND');

$response = $engine->request('channel/user/remove');
$engine->expectError('CHANNEL_NOT_FOUND');

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
