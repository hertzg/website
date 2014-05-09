#!/usr/bin/php
<?php

function expect_task_object ($engine, $variableName, $task) {
    $properties = ['id', 'text', 'tags', 'top_priority', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $task);
    $engine->expectNatural("$variableName.id", $task->id);
    $engine->expectType("$variableName.text", 'string', $task->text);
    $engine->expectType("$variableName.tags", 'string', $task->tags);
    $engine->expectType("$variableName.top_priority", 'boolean', $task->top_priority);
    $engine->expectNatural("$variableName.insert_time", $task->insert_time);
    $engine->expectNatural("$variableName.update_time", $task->update_time);
}

$new_task_text = 'sample task text';
$new_task_tags = 'tag1 tag2';
$new_task_top_priority = false;

$edit_task_text = 'edited text';
$edit_task_tags = 'tag1 tag2 tag3';
$edit_task_top_priority = true;

$manyTags = 'a b c d e f';

include_once 'classes/Engine.php';
$engine = new Engine;

$response = $engine->request('task/add');
$engine->expectError('ENTER_TEXT');

$response = $engine->request('task/add', [
    'text' => $new_task_text,
    'tags' => $manyTags,
    'top_priority' => $new_task_top_priority,
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('task/add', [
    'text' => $new_task_text,
    'tags' => $new_task_tags,
    'top_priority' => $new_task_top_priority,
]);
$engine->expectStatus(200);
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('task/get');
$engine->expectError('TASK_NOT_FOUND');

$response = $engine->request('task/get', ['id' => $id]);
$engine->expectStatus(200);
expect_task_object($engine, '', $response);
$engine->expectValue('.text', $new_task_text, $response->text);
$engine->expectValue('.tags', $new_task_tags, $response->tags);
$engine->expectValue('.top_priority', $new_task_top_priority, $response->top_priority);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('task/edit');
$engine->expectError('TASK_NOT_FOUND');

$response = $engine->request('task/edit', ['id' => $id]);
$engine->expectError('ENTER_TEXT');

$response = $engine->request('task/edit', [
    'id' => $id,
    'text' => $edit_task_text,
    'tags' => $manyTags,
    'top_priority' => $edit_task_top_priority,
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('task/edit', [
    'id' => $id,
    'text' => $edit_task_text,
    'tags' => $edit_task_tags,
    'top_priority' => $edit_task_top_priority,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('task/get', ['id' => $id]);
expect_task_object($engine, '', $response);
$engine->expectValue('.text', $edit_task_text, $response->text);
$engine->expectValue('.tags', $edit_task_tags, $response->tags);
$engine->expectValue('.top_priority', $edit_task_top_priority, $response->top_priority);

$response = $engine->request('task/list');
$engine->expectStatus(200);
$engine->expectType('', 'array', $response);
foreach ($response as $i => $task) {
    expect_task_object($engine, ".[$i]", $task);
}

$response = $engine->request('task/delete');
$engine->expectError('TASK_NOT_FOUND');

$response = $engine->request('task/delete', ['id' => $id]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('task/delete', ['id' => $id]);
$engine->expectError('TASK_NOT_FOUND');

$response = $engine->request('task/add', [
    'text' => $new_task_text,
    'tags' => $new_task_tags,
    'top_priority' => $new_task_top_priority,
]);
$engine->expectStatus(200);
$engine->expectNatural('', $response);

$response = $engine->request('task/deleteAll');
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('task/list');
$engine->expectStatus(200);
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo "Done\n";
echo "$engine->numRequests requests made.\n";
