#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('file/add');
$engine->expectError('ENTER_NAME');

$response = $engine->request('file/delete');
$engine->expectError('FILE_NOT_FOUND');

$response = $engine->request('file/download');
$engine->expectError('FILE_NOT_FOUND');

$response = $engine->request('file/get');
$engine->expectError('FILE_NOT_FOUND');

$response = $engine->request('file/rename');
$engine->expectError('FILE_NOT_FOUND');

$response = $engine->request('file/received/delete');
$engine->expectError('RECEIVED_FILE_NOT_FOUND');

$response = $engine->request('file/received/download');
$engine->expectError('RECEIVED_FILE_NOT_FOUND');

$response = $engine->request('file/received/get');
$engine->expectError('RECEIVED_FILE_NOT_FOUND');

$response = $engine->request('file/received/import');
$engine->expectError('RECEIVED_FILE_NOT_FOUND');

$response = $engine->request('file/received/importCopy');
$engine->expectError('RECEIVED_FILE_NOT_FOUND');

$response = $engine->request('file/send');
$engine->expectError('ENTER_RECEIVER_USERNAME');

$response = $engine->request('file/sendExisting');
$engine->expectError('FILE_NOT_FOUND');

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
