#!/usr/bin/php
<?php

function expect_note_object ($engine, $variableName, $note) {
    $properties = ['id', 'text', 'tags', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $note);
    $engine->expectNatural("$variableName.id", $note->id);
    $engine->expectType("$variableName.text", 'string', $note->text);
    $engine->expectType("$variableName.tags", 'string', $note->tags);
    $engine->expectNatural("$variableName.insert_time", $note->insert_time);
    $engine->expectNatural("$variableName.update_time", $note->update_time);
}

$newNoteText = 'sample note content';
$newNoteTags = 'tag1 tag2';
$editedNoteText = 'edited content';
$editedNoteTags = 'tag1 tag2 tag3';
$manyTags = 'a b c d e f';

include_once 'classes/Engine.php';
$engine = new Engine;

$response = $engine->request('note/add');
$engine->expectStatus(400);
$engine->expectError('ENTER_TEXT', $response);

$response = $engine->request('note/add', [
    'text' => $newNoteText,
    'tags' => $manyTags,
]);
$engine->expectStatus(400);
$engine->expectError('TOO_MANY_TAGS', $response);

$response = $engine->request('note/add', [
    'text' => $newNoteText,
    'tags' => $newNoteTags,
]);
$engine->expectStatus(200);
$engine->expectObject('', ['id'], $response);
$engine->expectNatural('.id', $response->id);

$id = $response->id;

$response = $engine->request('note/get');
$engine->expectStatus(400);
$engine->expectError('NOTE_NOT_FOUND', $response);

$note = $engine->request('note/get', ['id' => $id]);
$engine->expectStatus(200);
expect_note_object($engine, '', $note);
$engine->expectValue('.text', $newNoteText, $note->text);
$engine->expectValue('.tags', $newNoteTags, $note->tags);
$engine->expectEquals('.insert_time', '.update_time', $note->insert_time, $note->update_time);

$response = $engine->request('note/edit');
$engine->expectStatus(400);
$engine->expectError('NOTE_NOT_FOUND', $response);

$response = $engine->request('note/edit', ['id' => $id]);
$engine->expectStatus(400);
$engine->expectError('ENTER_TEXT', $response);

$response = $engine->request('note/edit', [
    'id' => $id,
    'text' => $editedNoteText,
    'tags' => $manyTags,
]);
$engine->expectStatus(400);
$engine->expectError('TOO_MANY_TAGS', $response);

$response = $engine->request('note/edit', [
    'id' => $id,
    'text' => $editedNoteText,
    'tags' => $editedNoteTags,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$note = $engine->request('note/get', ['id' => $id]);
expect_note_object($engine, '', $note);
$engine->expectValue('.text', $editedNoteText, $note->text);
$engine->expectValue('.tags', $editedNoteTags, $note->tags);

$notes = $engine->request('note/list');
$engine->expectStatus(200);
$engine->expectType('', 'array', $notes);
foreach ($notes as $i => $note) {
    expect_note_object($engine, ".[$i]", $note);
}

$response = $engine->request('note/delete');
$engine->expectStatus(400);
$engine->expectError('NOTE_NOT_FOUND', $response);

$response = $engine->request('note/delete', ['id' => $id]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('note/delete', ['id' => $id]);
$engine->expectStatus(400);
$engine->expectError('NOTE_NOT_FOUND', $response);

echo "Done\n";
echo "$engine->numRequests requests made.\n";
