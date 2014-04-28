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

$new_note_text = 'sample note content';
$new_note_tags = 'tag1 tag2';

$edited_note_text = 'edited content';
$edited_note_tags = 'tag1 tag2 tag3';

$manyTags = 'a b c d e f';

include_once 'classes/Engine.php';
$engine = new Engine;

$response = $engine->request('note/add');
$engine->expectStatus(400);
$engine->expectError('ENTER_TEXT', $response);

$response = $engine->request('note/add', [
    'text' => $new_note_text,
    'tags' => $manyTags,
]);
$engine->expectStatus(400);
$engine->expectError('TOO_MANY_TAGS', $response);

$response = $engine->request('note/add', [
    'text' => $new_note_text,
    'tags' => $new_note_tags,
]);
$engine->expectStatus(200);
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('note/get');
$engine->expectStatus(400);
$engine->expectError('NOTE_NOT_FOUND', $response);

$note = $engine->request('note/get', ['id' => $id]);
$engine->expectStatus(200);
expect_note_object($engine, '', $note);
$engine->expectValue('.text', $new_note_text, $note->text);
$engine->expectValue('.tags', $new_note_tags, $note->tags);
$engine->expectEquals('.insert_time', '.update_time', $note->insert_time, $note->update_time);

$response = $engine->request('note/edit');
$engine->expectStatus(400);
$engine->expectError('NOTE_NOT_FOUND', $response);

$response = $engine->request('note/edit', ['id' => $id]);
$engine->expectStatus(400);
$engine->expectError('ENTER_TEXT', $response);

$response = $engine->request('note/edit', [
    'id' => $id,
    'text' => $edited_note_text,
    'tags' => $manyTags,
]);
$engine->expectStatus(400);
$engine->expectError('TOO_MANY_TAGS', $response);

$response = $engine->request('note/edit', [
    'id' => $id,
    'text' => $edited_note_text,
    'tags' => $edited_note_tags,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$note = $engine->request('note/get', ['id' => $id]);
expect_note_object($engine, '', $note);
$engine->expectValue('.text', $edited_note_text, $note->text);
$engine->expectValue('.tags', $edited_note_tags, $note->tags);

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
