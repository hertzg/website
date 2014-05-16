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

chdir(__DIR__);

$new_note_text = 'sample note content';
$new_note_tags = 'tag1 tag2';

$edited_note_text = 'edited content';
$edited_note_tags = 'tag1 tag2 tag3';

$manyTags = 'a b c d e f';

include_once '../classes/Engine.php';
$engine = new Engine;

$response = $engine->request('note/add', [
    'text' => $new_note_text,
    'tags' => $manyTags,
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('note/add', [
    'text' => $new_note_text,
    'tags' => $new_note_tags,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('note/get', ['id' => $id]);
$engine->expectSuccess();
expect_note_object($engine, '', $response);
$engine->expectValue('.text', $new_note_text, $response->text);
$engine->expectValue('.tags', $new_note_tags, $response->tags);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('note/edit', ['id' => $id]);
$engine->expectError('ENTER_TEXT');

$response = $engine->request('note/edit', [
    'id' => $id,
    'text' => $edited_note_text,
    'tags' => $manyTags,
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('note/edit', [
    'id' => $id,
    'text' => $edited_note_text,
    'tags' => $edited_note_tags,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('note/get', ['id' => $id]);
expect_note_object($engine, '', $response);
$engine->expectValue('.text', $edited_note_text, $response->text);
$engine->expectValue('.tags', $edited_note_tags, $response->tags);

$response = $engine->request('note/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $note) {
    expect_note_object($engine, ".[$i]", $note);
}

$response = $engine->request('note/delete', ['id' => $id]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('note/delete', ['id' => $id]);
$engine->expectError('NOTE_NOT_FOUND');

$response = $engine->request('note/add', [
    'text' => $new_note_text,
    'tags' => $new_note_tags,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$response = $engine->request('note/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('note/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
