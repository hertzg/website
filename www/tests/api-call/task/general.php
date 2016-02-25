#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$text = 'sample text';
$tags = 'sample tags';
$top_priority = true;

$response = $engine->request('task/add', [
    'text' => $text,
    'tags' => 'a b c d e f',
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('task/add', [
    'text' => $text,
    'tags' => $tags,
    'top_priority' => $top_priority,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

include_once 'fns/expect_task_object.php';
$response = $engine->request('task/get', ['id' => $id]);
$engine->expectSuccess();
expect_task_object($engine, '', $response);
$engine->expectValue('.text', $text, $response->text);
$engine->expectValue('.tags', $tags, $response->tags);
$engine->expectValue('.top_priority', $top_priority, $response->top_priority);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('task/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $task) {
    expect_task_object($engine, ".[$i]", $task);
}

$response = $engine->request('task/delete', ['id' => $id]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('task/delete', ['id' => $id]);
$engine->expectError('TASK_NOT_FOUND');

$response = $engine->request('task/add', [
    'text' => $text,
    'tags' => $tags,
    'top_priority' => $top_priority,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$response = $engine->request('task/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('task/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
