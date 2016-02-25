#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

function expect_imported ($engine, $receivedNote, $response) {
    include_once 'fns/expect_note_object.php';
    expect_note_object($engine, '', $response);
    $engine->expectValue('.text', $receivedNote->text, $response->text);
    $engine->expectValue('.tags', $receivedNote->tags, $response->tags);
}

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive($engine->numRequests);

$response = $engine->request('note/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_note_object.php';
foreach ($response as $i => $receivedNote) {

    expect_received_note_object($engine, "[$i]", $receivedNote);

    $id = $receivedNote->id;

    $response = $engine->request('note/received/importCopy', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectNatural('', $response);

    $note_id = $response;

    $response = $engine->request('note/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_note_object($engine, '', $response);

    $response = $engine->request('note/get', [
        'id' => $note_id,
    ]);
    $engine->expectSuccess();
    expect_imported($engine, $receivedNote, $response);

    $response = $engine->request('note/received/import', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectNatural('', $response);

    $note_id = $response;

    $response = $engine->request('note/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_NOTE_NOT_FOUND');

    $response = $engine->request('note/get', [
        'id' => $note_id,
    ]);
    $engine->expectSuccess();
    expect_imported($engine, $receivedNote, $response);

    $response = $engine->request('note/delete', [
        'id' => $note_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

}

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
