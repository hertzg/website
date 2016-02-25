#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive($engine->numRequests);

$ids = [];

$response = $engine->request('note/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_note_object.php';
foreach ($response as $i => $receivedNote) {
    expect_received_note_object($engine, "[$i]", $receivedNote);
    $ids[] = $receivedNote->id;
}

foreach ($ids as $id) {

    $response = $engine->request('note/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_note_object($engine, '', $response);

    $response = $engine->request('note/received/delete', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

    $response = $engine->request('note/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_NOTE_NOT_FOUND');

}

receive($engine->numRequests);

$response = $engine->request('note/received/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('note/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
