#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive();

$response = $engine->request('file/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_file_object.php';
foreach ($response as $i => $receivedFile) {

    expect_received_file_object($engine, "[$i]", $receivedFile);

    $id = $receivedFile->id;
    $name = $receivedFile->name;

    $response = $engine->request('file/received/import', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectNatural('', $response);

    $file_id = $response;

    $response = $engine->request('file/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_FILE_NOT_FOUND');

    $response = $engine->request('file/get', [
        'id' => $file_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('.name', $name, $response->name);

    $response = $engine->request('file/received/importCopy', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_file_object($engine, '', $response);

    $file_id = $response;

    $response = $engine->request('file/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();

    $response = $engine->request('file/get', [
        'id' => $file_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('.name', $name, $response->name);

    $response = $engine->request('file/delete', [
        'id' => $file_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

}

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
