#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('note/add', [
    'text' => 'sample text',
    'tags' => 'sample tags',
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('note/edit', ['id' => $id]);
$engine->expectError('ENTER_TEXT');

$text = 'edited text';
$tags = 'edited tags';

$response = $engine->request('note/edit', [
    'id' => $id,
    'text' => $text,
    'tags' => 'a b c d e f',
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('note/edit', [
    'id' => $id,
    'text' => $text,
    'tags' => $tags,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

include_once 'fns/expect_note_object.php';
$response = $engine->request('note/get', ['id' => $id]);
expect_note_object($engine, '', $response);
$engine->expectValue('.text', $text, $response->text);
$engine->expectValue('.tags', $tags, $response->tags);

$response = $engine->request('note/delete', ['id' => $id]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
