#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$text = 'sample text';
$tags = 'sample tags';

$response = $engine->request('note/add', [
    'text' => $text,
    'tags' => 'a b c d e f',
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('note/add', [
    'text' => $text,
    'tags' => $tags,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

include_once 'fns/expect_note_object.php';
$response = $engine->request('note/get', ['id' => $id]);
$engine->expectSuccess();
expect_note_object($engine, '', $response);
$engine->expectValue('.text', $text, $response->text);
$engine->expectValue('.tags', $tags, $response->tags);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('note/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $note) {
    expect_note_object($engine, "[$i]", $note);
}

$response = $engine->request('note/delete', ['id' => $id]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('note/delete', ['id' => $id]);
$engine->expectError('NOTE_NOT_FOUND');

$response = $engine->request('note/add', [
    'text' => $text,
    'tags' => $tags,
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

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
