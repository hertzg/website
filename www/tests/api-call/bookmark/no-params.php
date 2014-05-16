#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$response = $engine->request('bookmark/add');
$engine->expectError('ENTER_URL');

$response = $engine->request('bookmark/delete');
$engine->expectError('BOOKMARK_NOT_FOUND');

$response = $engine->request('bookmark/edit');
$engine->expectError('BOOKMARK_NOT_FOUND');

$response = $engine->request('bookmark/get');
$engine->expectError('BOOKMARK_NOT_FOUND');

$response = $engine->request('bookmark/received/get');
$engine->expectError('RECEIVED_BOOKMARK_NOT_FOUND');

$response = $engine->request('bookmark/received/delete');
$engine->expectError('RECEIVED_BOOKMARK_NOT_FOUND');

$response = $engine->request('bookmark/send');
$engine->expectError('ENTER_RECEIVER_USERNAME');

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
