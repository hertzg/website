#!/usr/bin/php
<?php

chdir(__DIR__);

include_once 'fns/expect_file_object.php';

$tempName = sys_get_temp_dir().'/test_'.rand();
file_put_contents($tempName, 'test content '.rand());
$file = new CURLFile($tempName);

include_once '../classes/Engine.php';
$engine = new Engine;

$new_name = 'test file name';
$edited_name = 'test edited name';

$response = $engine->request('file/add');
$engine->expectError('ENTER_NAME');

$response = $engine->request('file/add', [
    'name' => $new_name,
]);
$engine->expectError('SELECT_FILE');

$response = $engine->request('file/add', [
    'name' => $new_name,
    'file' => $file,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('file/add', [
    'name' => $new_name,
    'file' => $file,
]);
$engine->expectError('FILE_ALREADY_EXISTS');

$response = $engine->request('file/get');
$engine->expectError('FILE_NOT_FOUND');

$response = $engine->request('file/get', [
    'id' => $id,
]);
$engine->expectSuccess();
expect_file_object($engine, '', $response);
$engine->expectValue('.name', $new_name, $response->name);

$response = $engine->request('file/rename');
$engine->expectError('FILE_NOT_FOUND');

$response = $engine->request('file/rename', [
    'id' => $id,
]);
$engine->expectError('ENTER_NAME');

$response = $engine->request('file/rename', [
    'id' => $id,
    'name' => $edited_name,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('file/get', [
    'id' => $id,
]);
$engine->expectSuccess();
expect_file_object($engine, '', $response);
$engine->expectValue('.name', $edited_name, $response->name);
$engine->expectEquals('.insert_time', '.rename_time',
    $response->insert_time, $response->rename_time);

$response = $engine->request('file/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $file) {
    expect_file_object($engine, "[$i]", $file);
}

$response = $engine->request('file/delete');
$engine->expectError('FILE_NOT_FOUND');

$response = $engine->request('file/delete', [
    'id' => $id,
]);
$engine->expectSuccess();

$response = $engine->request('file/get', [
    'id' => $id,
]);
$engine->expectError('FILE_NOT_FOUND');

unset($tempName);

echo "Done\n";
echo "$engine->numRequests requests made.\n";
