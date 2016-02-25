#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

function expect_imported ($engine, $receivedFile, $response) {
    include_once 'fns/expect_file_object.php';
    expect_file_object($engine, '', $response);
    $engine->expectValue('.name', $receivedFile->name, $response->name);
}

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive($engine->numRequests);

$response = $engine->request('file/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_file_object.php';
foreach ($response as $i => $receivedFile) {

    expect_received_file_object($engine, "[$i]", $receivedFile);

    $id = $receivedFile->id;

    $response = $engine->request('file/received/importCopy', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectNatural('', $response);

    $file_id = $response;

    $response = $engine->request('file/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_file_object($engine, '', $response);

    $response = $engine->request('file/get', [
        'id' => $file_id,
    ]);
    $engine->expectSuccess();
    expect_imported($engine, $receivedFile, $response);

    $response = $engine->request('file/received/import', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_file_object($engine, '', $response);

    $file_id = $response;

    $response = $engine->request('file/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_FILE_NOT_FOUND');

    $response = $engine->request('file/get', [
        'id' => $file_id,
    ]);
    $engine->expectSuccess();
    expect_imported($engine, $receivedFile, $response);

    $response = $engine->request('file/delete', [
        'id' => $file_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

}

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
