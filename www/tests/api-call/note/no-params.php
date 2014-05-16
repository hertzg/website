#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$response = $engine->request('note/add');
$engine->expectError('ENTER_TEXT');

$response = $engine->request('note/delete');
$engine->expectError('NOTE_NOT_FOUND');

$response = $engine->request('note/edit');
$engine->expectError('NOTE_NOT_FOUND');

$response = $engine->request('note/get');
$engine->expectError('NOTE_NOT_FOUND');

$response = $engine->request('note/received/get');
$engine->expectError('RECEIVED_NOTE_NOT_FOUND');

$response = $engine->request('note/received/delete');
$engine->expectError('RECEIVED_NOTE_NOT_FOUND');

$response = $engine->request('note/send');
$engine->expectError('ENTER_RECEIVER_USERNAME');

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
