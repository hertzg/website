#!/usr/bin/php
<?php

function expect_received_note_object ($engine, $variableName, $receivedNote) {
    $properties = ['id', 'sender_username', 'text', 'tags', 'insert_time'];
    $engine->expectObject($variableName, $properties, $receivedNote);
    $engine->expectNatural("$variableName.id", $receivedNote->id);
    $engine->expectType("$variableName.sender_username",
        'string', $receivedNote->sender_username);
    $engine->expectType("$variableName.text", 'string', $receivedNote->text);
    $engine->expectType("$variableName.tags", 'string', $receivedNote->tags);
    $engine->expectNatural("$variableName.insert_time", $receivedNote->insert_time);
}

function receive () {

    include_once '../fns/get_sender_engine.php';
    $engine = get_sender_engine();

    $engine->request('note/send', [
        'text' => 'sample text',
        'tags' => 'tag1 tag2',
        'receiver_username' => 'aimnadze',
    ]);
    $engine->expectSuccess();

}

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

receive();

$ids = [];

$response = $engine->request('note/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
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

receive();

$response = $engine->request('note/received/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('note/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
