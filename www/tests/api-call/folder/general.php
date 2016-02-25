#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$name = 'sample name';
$edited_name = 'sample edited name';

$response = $engine->request('folder/add', [
    'name' => $name,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('folder/add', [
    'name' => $name,
]);
$engine->expectError('FOLDER_ALREADY_EXISTS');

include_once 'fns/expect_folder_object.php';
$response = $engine->request('folder/get', [
    'id' => $id,
]);
$engine->expectSuccess();
expect_folder_object($engine, '', $response);
$engine->expectValue('.name', $response->name, $name);
$engine->expectEquals('.insert_time', '.rename_time',
    $response->insert_time, $response->rename_time);

$response = $engine->request('folder/list');
$engine->expectType('', 'array', $response);
foreach ($response as $i => $folder) {
    expect_folder_object($engine, "[$i]", $folder);
}

$response = $engine->request('folder/delete', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('folder/delete', [
    'id' => $id,
]);
$engine->expectError('FOLDER_NOT_FOUND');

$response = $engine->request('folder/get', [
    'id' => $id,
]);
$engine->expectError('FOLDER_NOT_FOUND');

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
