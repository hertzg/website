#!/usr/bin/php
<?php

function expect_folder_object ($engine, $variableName, $folder) {
    $engine->expectObject('', ['id', 'name', 'insert_time'], $folder);
    $engine->expectNatural('', $folder->id);
    $engine->expectType('.name', 'string', $folder->name);
    $engine->expectNatural('', $folder->insert_time);
}

include_once '../classes/Engine.php';
$engine = new Engine;

$new_name = 'test folder name';

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

$response = $engine->request('folder/get');
$engine->expectError('FOLDER_NOT_FOUND');

$response = $engine->request('folder/get', [
    'id' => $id,
]);
$engine->expectSuccess();
expect_folder_object($engine, '', $response);

$response = $engine->request('folder/list');
$engine->expectType('', 'array', $response);
foreach ($response as $i => $folder) {
    expect_folder_object($engine, "[$i]", $folder);
}

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

$response = $engine->request('folder/get', [
    'id' => $id,
]);
$engine->expectError('FOLDER_NOT_FOUND');

echo "Done\n";
echo "$engine->numRequests requests made.\n";
