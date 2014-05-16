#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$response = $engine->request('channel/add');
$engine->expectError('ENTER_CHANNEL_NAME');

$response = $engine->request('channel/edit');
$engine->expectError('CHANNEL_NOT_FOUND');

$response = $engine->request('channel/get');
$engine->expectError('CHANNEL_NOT_FOUND');

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
