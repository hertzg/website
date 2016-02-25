#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive($engine->numRequests);

$ids = [];

$response = $engine->request('file/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_file_object.php';
foreach ($response as $i => $receivedFile) {
    expect_received_file_object($engine, "[$i]", $receivedFile);
    $ids[] = $receivedFile->id;
}

foreach ($ids as $id) {

    $response = $engine->request('file/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_file_object($engine, '', $response);

    $response = $engine->download('file/received/download', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectType('', 'string', $response);

    $response = $engine->request('file/received/delete', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

    $response = $engine->request('file/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_FILE_NOT_FOUND');

}

receive($engine->numRequests);

$response = $engine->request('file/received/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('file/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
