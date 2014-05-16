#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$new_name = 'test file name';

$response = $engine->request('file/add');
$engine->expectError('ENTER_NAME');

$response = $engine->request('file/add', [
    'name' => $new_name,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('file/delete');
$engine->expectError('FILE_NOT_FOUND');

$response = $engine->request('file/delete', [
    'id' => $id,
]);
$engine->expectSuccess();

echo "Done\n";
echo "$engine->numRequests requests made.\n";
