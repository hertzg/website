#!/usr/bin/php
<?php

include_once 'classes/Engine.php';
$engine = new Engine;

$response = $engine->request('note/add', []);
$engine->expectStatus(400);
$engine->expectError($response, 'ENTER_TEXT');

$response = $engine->request('note/add', [
    'text' => 'sample note content',
]);
$engine->expectStatus(200);
$engine->expectObject($response, ['id']);
$engine->expectType('.id', 'integer', $response->id);

$id = $response->id;

$response = $engine->request('note/edit', [
    'id' => $id,
    'text' => 'edited content',
]);
$engine->expectStatus(200);
$engine->expectType('boolean', $response);

$notes = $engine->request('note/list', []);
$engine->expectStatus(200);
$engine->expectType('', 'array', $notes);
foreach ($notes as $i => $note) {
    $engine->expectObject($note, ['id', 'text', 'tags', 'insert_time', 'update_time']);
    $engine->expectType("[$i].id", 'integer', $note->id);
    $engine->expectType("[$i].text", 'string', $note->text);
    $engine->expectType("[$i].tags", 'string', $note->tags);
    $engine->expectType("[$i].insert_time", 'integer', $note->insert_time);
    $engine->expectType("[$i].update_time", 'integer', $note->update_time);
}

echo "Done\n";
