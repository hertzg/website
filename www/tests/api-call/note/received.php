#!/usr/bin/php
<?php

function expect_received_note_object ($engine, $variableName, $receivedNote) {
    $properties = ['id', 'sender_username', 'text', 'tags', 'insert_time'];
    $engine->expectObject($variableName, $properties, $receivedNote);
    $engine->expectNatural("$variableName.id", $receivedNote->id);
    $engine->expectType("$variableName.sender_username", 'string', $receivedNote->sender_username);
    $engine->expectType("$variableName.text", 'string', $receivedNote->text);
    $engine->expectType("$variableName.tags", 'string', $receivedNote->tags);
    $engine->expectNatural("$variableName.insert_time", $receivedNote->insert_time);
}

chdir(__DIR__);

include_once '../classes/Engine.php';

$engine = new Engine;
$engine->api_key = '6dd831e2f696691091a36b5b4d400e6af6a4fe4c68d3ab2727432338a258144d';
$engine->request('note/send', [
    'text' => 'sample text',
    'tags' => 'tag1 tag2',
    'receiver_username' => 'aimnadze',
]);
$engine->expectSuccess();

$engine = new Engine;

$ids = [];

$response = $engine->request('note/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $receivedNote) {
    expect_received_note_object($engine, "[$i]", $receivedNote);
    $ids[] = $receivedNote->id;
}

$response = $engine->request('note/received/get');
$engine->expectError('RECEIVED_NOTE_NOT_FOUND');

$response = $engine->request('note/received/delete');
$engine->expectError('RECEIVED_NOTE_NOT_FOUND');

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

echo "Done\n";
echo "$engine->numRequests requests made.\n";
