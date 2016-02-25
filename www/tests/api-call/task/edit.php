#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('task/add', [
    'text' => 'sample text',
    'tags' => 'sample tags',
    'top_priority' => false,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('task/edit', ['id' => $id]);
$engine->expectError('ENTER_TEXT');

$text = 'edited text';
$tags = 'edited tags';
$top_priority = true;

$response = $engine->request('task/edit', [
    'id' => $id,
    'text' => $text,
    'tags' => 'a b c d e f',
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('task/edit', [
    'id' => $id,
    'text' => $text,
    'tags' => $tags,
    'top_priority' => $top_priority,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

include_once 'fns/expect_task_object.php';
$response = $engine->request('task/get', ['id' => $id]);
expect_task_object($engine, '', $response);
$engine->expectValue('.text', $text, $response->text);
$engine->expectValue('.tags', $tags, $response->tags);
$engine->expectValue('.top_priority', $top_priority, $response->top_priority);

$response = $engine->request('task/delete', ['id' => $id]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
