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

$newTaskText = 'sample task text';
$newTaskTags = 'tag1 tag2';
$newTaskTopPriority = false;
$editedTaskText = 'edited text';
$editedTaskTags = 'tag1 tag2 tag3';
$editedTaskTopPriority = true;
$manyTags = 'a b c d e f';

include_once 'classes/Engine.php';
$engine = new Engine;

$response = $engine->request('task/add');
$engine->expectStatus(400);
$engine->expectError('ENTER_TEXT', $response);

$response = $engine->request('task/add', [
    'text' => $newTaskText,
    'tags' => $manyTags,
    'top_priority' => $newTaskTopPriority,
]);
$engine->expectStatus(400);
$engine->expectError('TOO_MANY_TAGS', $response);

$response = $engine->request('task/add', [
    'text' => $newTaskText,
    'tags' => $newTaskTags,
    'top_priority' => $newTaskTopPriority,
]);
$engine->expectStatus(200);
$engine->expectObject('', ['id'], $response);
$engine->expectNatural('.id', $response->id);

$id = $response->id;

$response = $engine->request('task/get');
$engine->expectStatus(400);
$engine->expectError('TASK_NOT_FOUND', $response);

$task = $engine->request('task/get', ['id' => $id]);
$engine->expectStatus(200);
expect_task_object($engine, '', $task);
$engine->expectValue('.text', $newTaskText, $task->text);
$engine->expectValue('.tags', $newTaskTags, $task->tags);
$engine->expectValue('.top_priority', $newTaskTopPriority, $task->top_priority);
$engine->expectEquals('.insert_time', '.update_time', $task->insert_time, $task->update_time);

$response = $engine->request('task/edit');
$engine->expectStatus(400);
$engine->expectError('TASK_NOT_FOUND', $response);

$response = $engine->request('task/edit', ['id' => $id]);
$engine->expectStatus(400);
$engine->expectError('ENTER_TEXT', $response);

$response = $engine->request('task/edit', [
    'id' => $id,
    'text' => $editedTaskText,
    'tags' => $manyTags,
    'top_priority' => $editedTaskTopPriority,
]);
$engine->expectStatus(400);
$engine->expectError('TOO_MANY_TAGS', $response);

$response = $engine->request('task/edit', [
    'id' => $id,
    'text' => $editedTaskText,
    'tags' => $editedTaskTags,
    'top_priority' => $editedTaskTopPriority,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$task = $engine->request('task/get', ['id' => $id]);
expect_task_object($engine, '', $task);
$engine->expectValue('.text', $editedTaskText, $task->text);
$engine->expectValue('.tags', $editedTaskTags, $task->tags);
$engine->expectValue('.top_priority', $editedTaskTopPriority, $task->top_priority);

$tasks = $engine->request('task/list');
$engine->expectStatus(200);
$engine->expectType('', 'array', $tasks);
foreach ($tasks as $i => $task) {
    expect_task_object($engine, ".[$i]", $task);
}

$response = $engine->request('task/delete');
$engine->expectStatus(400);
$engine->expectError('TASK_NOT_FOUND', $response);

$response = $engine->request('task/delete', ['id' => $id]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('task/delete', ['id' => $id]);
$engine->expectStatus(400);
$engine->expectError('TASK_NOT_FOUND', $response);

echo "Done\n";
echo "$engine->numRequests requests made.\n";
