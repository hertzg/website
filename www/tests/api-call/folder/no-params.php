#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('folder/add');
$engine->expectError('ENTER_NAME');

$response = $engine->request('folder/delete');
$engine->expectError('FOLDER_NOT_FOUND');

$response = $engine->request('folder/get');
$engine->expectError('FOLDER_NOT_FOUND');

$response = $engine->request('folder/rename');
$engine->expectError('FOLDER_NOT_FOUND');

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
