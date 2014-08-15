#!/usr/bin/php
<?php

function expect_folder_object ($engine, $variableName, $folder) {
    $engine->expectObject('', ['id', 'name', 'insert_time'], $folder);
    $engine->expectNatural('', $folder->id);
    $engine->expectType('.name', 'string', $folder->name);
    $engine->expectNatural('', $folder->insert_time);
}

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$response = $engine->request('folder/add', [
    'name' => 'wrapper folder',
]);
$engine->expectSuccess();

$parent_id = $response;

$new_name = 'test folder name';

$response = $engine->request('folder/add', [
    'name' => $new_name,
    'parent_id' => $parent_id,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('folder/add', [
    'name' => $new_name,
    'parent_id' => $parent_id,
]);
$engine->expectError('FOLDER_ALREADY_EXISTS');

$response = $engine->request('folder/get', [
    'id' => $id,
]);
$engine->expectSuccess();
expect_folder_object($engine, '', $response);

$response = $engine->request('folder/list', [
    'parent_id' => $parent_id,
]);
$engine->expectType('', 'array', $response);
foreach ($response as $i => $folder) {
    expect_folder_object($engine, "[$i]", $folder);
}

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

$response = $engine->request('folder/delete', [
    'id' => $parent_id,
]);
$engine->expectSuccess();

echo "Done\n";
echo "$engine->numRequests requests made.\n";
