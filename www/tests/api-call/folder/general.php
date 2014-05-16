#!/usr/bin/php
<?php

include_once '../classes/Engine.php';
$engine = new Engine;

$new_name = 'new folder name';

$response = $engine->request('folder/add');
$engine->expectError('ENTER_NAME');

$response = $engine->request('folder/add', [
    'name' => $new_name,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('folder/add', [
    'name' => $new_name,
]);
$engine->expectError('FOLDER_ALREADY_EXISTS');

$response = $engine->request('folder/delete');
$engine->expectError('FOLDER_NOT_FOUND');

$response = $engine->request('folder/delete', [
    'id' => $id,
]);
$engine->expectSuccess();

$response = $engine->request('folder/delete', [
    'id' => $id,
]);
$engine->expectError('FOLDER_NOT_FOUND');

echo "Done\n";
echo "$engine->numRequests requests made.\n";
