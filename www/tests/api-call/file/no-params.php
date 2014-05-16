#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$response = $engine->request('file/add');
$engine->expectError('ENTER_NAME');

$response = $engine->request('file/get');
$engine->expectError('FILE_NOT_FOUND');

$response = $engine->request('file/rename');
$engine->expectError('FILE_NOT_FOUND');

$response = $engine->request('file/delete');
$engine->expectError('FILE_NOT_FOUND');

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
