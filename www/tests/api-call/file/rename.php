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

$name1 = 'sample name 1';
$name2 = 'sample name 2';
$edited_name = 'sample edited name';

$response = $engine->request('file/add', [
    'name' => $name1,
    'file' => $file,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id1 = $response;

$response = $engine->request('file/add', [
    'name' => $name2,
    'file' => $file,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id2 = $response;

$response = $engine->request('file/rename', [
    'id' => $id1,
]);
$engine->expectError('ENTER_NAME');

$engine->request('file/rename', [
    'id' => $id1,
    'name' => $name2,
]);
$engine->expectError('FILE_ALREADY_EXISTS');

$response = $engine->request('file/rename', [
    'id' => $id1,
    'name' => $edited_name,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('file/get', [
    'id' => $id1,
]);
$engine->expectSuccess();
include_once 'fns/expect_file_object.php';
expect_file_object($engine, '', $response);
$engine->expectValue('', $edited_name, $response->name);

$response = $engine->request('file/delete', [
    'id' => $id1,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('file/delete', [
    'id' => $id2,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

unlink($tempName);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
