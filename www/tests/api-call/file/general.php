#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$content = 'test content '.rand();

$tempName = sys_get_temp_dir().'/test_'.rand();
file_put_contents($tempName, $content);
$file = new CURLFile($tempName);

$new_name = 'test file name';
$edited_name = 'test edited name';

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

include_once 'fns/expect_file_object.php';
$response = $engine->request('file/get', [
    'id' => $id,
]);
$engine->expectSuccess();
expect_file_object($engine, '', $response);
$engine->expectValue('.name', $new_name, $response->name);

$response = $engine->download('file/download', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', $content, $response);

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

$response = $engine->request('file/delete', [
    'id' => $id,
]);
$engine->expectSuccess();

$response = $engine->request('file/get', [
    'id' => $id,
]);
$engine->expectError('FILE_NOT_FOUND');

unlink($tempName);

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
