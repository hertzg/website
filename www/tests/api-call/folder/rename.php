#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$name1 = 'sample name 1';
$name2 = 'sample name 2';
$edited_name = 'sample edited name';

$response = $engine->request('folder/add', [
    'name' => $name1,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id1 = $response;

$response = $engine->request('folder/add', [
    'name' => $name2,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id2 = $response;

$response = $engine->request('folder/rename', [
    'id' => $id1,
]);
$engine->expectError('ENTER_NAME');

$response = $engine->request('folder/rename', [
    'id' => $id1,
    'name' => $name2,
]);
$engine->expectError('FOLDER_ALREADY_EXISTS');

$response = $engine->request('folder/rename', [
    'id' => $id1,
    'name' => $edited_name,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('folder/get', [
    'id' => $id1,
]);
$engine->expectSuccess();
include_once 'fns/expect_folder_object.php';
expect_folder_object($engine, '', $response);
$engine->expectValue('.name', $edited_name, $response->name);

$response = $engine->request('folder/delete', [
    'id' => $id1,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('folder/delete', [
    'id' => $id2,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
