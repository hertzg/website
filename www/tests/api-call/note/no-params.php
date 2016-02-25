#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('note/add');
$engine->expectError('ENTER_TEXT');

$response = $engine->request('note/delete');
$engine->expectError('NOTE_NOT_FOUND');

$response = $engine->request('note/edit');
$engine->expectError('NOTE_NOT_FOUND');

$response = $engine->request('note/get');
$engine->expectError('NOTE_NOT_FOUND');

$response = $engine->request('note/received/delete');
$engine->expectError('RECEIVED_NOTE_NOT_FOUND');

$response = $engine->request('note/received/get');
$engine->expectError('RECEIVED_NOTE_NOT_FOUND');

$response = $engine->request('note/received/import');
$engine->expectError('RECEIVED_NOTE_NOT_FOUND');

$response = $engine->request('note/received/importCopy');
$engine->expectError('RECEIVED_NOTE_NOT_FOUND');

$response = $engine->request('note/send');
$engine->expectError('ENTER_RECEIVER_USERNAME');

$response = $engine->request('note/sendExisting');
$engine->expectError('NOTE_NOT_FOUND');

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
