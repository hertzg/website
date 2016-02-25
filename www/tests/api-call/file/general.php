#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$content = 'test content';

$tempName = sys_get_temp_dir().'/test_'.rand();
file_put_contents($tempName, $content);
$file = new CURLFile($tempName);

$name = 'sample name';
$edited_name = 'sample edited name';

$response = $engine->request('file/add', [
    'name' => $name,
]);
$engine->expectError('SELECT_FILE');

$response = $engine->request('file/add', [
    'name' => $name,
    'file' => $file,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('file/add', [
    'name' => $name,
    'file' => $file,
]);
$engine->expectError('FILE_ALREADY_EXISTS');

$response = $engine->request('file/get', [
    'id' => $id,
]);
$engine->expectSuccess();
include_once 'fns/expect_file_object.php';
expect_file_object($engine, '', $response);
$engine->expectValue('.name', $name, $response->name);
$engine->expectEquals('.insert_time', '.rename_time',
    $response->insert_time, $response->rename_time);

$response = $engine->download('file/download', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', $content, $response);

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

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
