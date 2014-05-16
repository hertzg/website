#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$response = $engine->request('task/add');
$engine->expectError('ENTER_TEXT');

$response = $engine->request('task/get');
$engine->expectError('TASK_NOT_FOUND');

$response = $engine->request('task/edit');
$engine->expectError('TASK_NOT_FOUND');

$response = $engine->request('task/delete');
$engine->expectError('TASK_NOT_FOUND');

$response = $engine->request('task/received/get');
$engine->expectError('RECEIVED_TASK_NOT_FOUND');

$response = $engine->request('task/received/delete');
$engine->expectError('RECEIVED_TASK_NOT_FOUND');

$response = $engine->request('task/send');
$engine->expectError('ENTER_RECEIVER_USERNAME');

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
