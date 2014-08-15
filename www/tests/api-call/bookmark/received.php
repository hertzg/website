#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive();

$ids = [];

$response = $engine->request('bookmark/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_bookmark_object.php';
foreach ($response as $i => $receivedBookmark) {
    expect_received_bookmark_object($engine, "[$i]", $receivedBookmark);
    $ids[] = $receivedBookmark->id;
}

foreach ($ids as $id) {

    $response = $engine->request('bookmark/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_bookmark_object($engine, '', $response);

    $response = $engine->request('bookmark/received/delete', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

    $response = $engine->request('bookmark/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_BOOKMARK_NOT_FOUND');

}

receive();

$response = $engine->request('bookmark/received/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('bookmark/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
