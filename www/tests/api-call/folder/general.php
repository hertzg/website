#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'fns/expect_folder_object.php';

include_once '../classes/Engine.php';
$engine = new Engine;

$new_name = 'test folder name';
$edited_name = 'edited folder name';

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

$response = $engine->request('folder/get', [
    'id' => $id,
]);
$engine->expectSuccess();
expect_folder_object($engine, '', $response);
$engine->expectValue('.name', $response->name, $new_name);
$engine->expectEquals('.insert_time', '.rename_time',
    $response->insert_time, $response->rename_time);

$response = $engine->request('folder/rename', [
    'id' => $id,
]);
$engine->expectError('ENTER_NAME');

$response = $engine->request('folder/rename', [
    'id' => $id,
    'name' => $edited_name,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('folder/get', [
    'id' => $id,
]);
$engine->expectSuccess();
expect_folder_object($engine, '', $response);
$engine->expectValue('.name', $response->name, $edited_name);

$response = $engine->request('folder/list');
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

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
