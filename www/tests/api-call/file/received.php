#!/usr/bin/php
<?php

function expect_received_file_object ($engine, $variableName, $receivedFile) {
    $properties = ['id', 'sender_username', 'name', 'size', 'insert_time'];
    $engine->expectObject($variableName, $properties, $receivedFile);
    $engine->expectNatural("$variableName.id", $receivedFile->id);
    $engine->expectType("$variableName.sender_username",
        'string', $receivedFile->sender_username);
    $engine->expectType("$variableName.name", 'string', $receivedFile->name);
    $engine->expectNatural("$variableName.size", $receivedFile->size);
    $engine->expectNatural("$variableName.insert_time", $receivedFile->insert_time);
}

function receive () {

    $tempName = sys_get_temp_dir().'/test_'.rand();
    file_put_contents($tempName, 'test content '.rand());
    $file = new CURLFile($tempName);

    include_once '../fns/get_sender_engine.php';
    $engine = get_sender_engine();

    $engine->request('file/send', [
        'name' => 'sample name',
        'file' => $file,
        'receiver_username' => 'aimnadze',
    ]);
    $engine->expectSuccess();

}

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

receive();

$ids = [];

$response = $engine->request('file/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
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

receive();

$response = $engine->request('file/received/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('file/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
