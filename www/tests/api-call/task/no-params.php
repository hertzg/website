#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('task/add');
$engine->expectError('ENTER_TEXT');

$response = $engine->request('task/delete');
$engine->expectError('TASK_NOT_FOUND');

$response = $engine->request('task/edit');
$engine->expectError('TASK_NOT_FOUND');

$response = $engine->request('task/get');
$engine->expectError('TASK_NOT_FOUND');

$response = $engine->request('task/received/delete');
$engine->expectError('RECEIVED_TASK_NOT_FOUND');

$response = $engine->request('task/received/get');
$engine->expectError('RECEIVED_TASK_NOT_FOUND');

$response = $engine->request('task/received/import');
$engine->expectError('RECEIVED_TASK_NOT_FOUND');

$response = $engine->request('task/received/importCopy');
$engine->expectError('RECEIVED_TASK_NOT_FOUND');

$response = $engine->request('task/send');
$engine->expectError('ENTER_RECEIVER_USERNAME');

$response = $engine->request('task/sendExisting');
$engine->expectError('TASK_NOT_FOUND');

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
