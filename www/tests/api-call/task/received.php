#!/usr/bin/php
<?php

function expect_received_task_object ($engine, $variableName, $receivedTask) {
    $properties = ['id', 'sender_username', 'text',
        'top_priority', 'tags', 'insert_time'];
    $engine->expectObject($variableName, $properties, $receivedTask);
    $engine->expectNatural("$variableName.id", $receivedTask->id);
    $engine->expectType("$variableName.sender_username",
        'string', $receivedTask->sender_username);
    $engine->expectType("$variableName.text", 'string', $receivedTask->text);
    $engine->expectType("$variableName.top_priority",
        'boolean', $receivedTask->top_priority);
    $engine->expectType("$variableName.tags", 'string', $receivedTask->tags);
    $engine->expectNatural("$variableName.insert_time",
        $receivedTask->insert_time);
}

function receive () {
    $engine = new Engine;
    $engine->api_key = 'fc9418fe96d7062d20251a60d46889f01b08c5bfe803244f71dd6ac1f3c42e3c';
    $engine->request('task/send', [
        'text' => 'sample text',
        'top_priority' => true,
        'tags' => 'tag1 tag2',
        'receiver_username' => 'aimnadze',
    ]);
    $engine->expectSuccess();
}

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

receive();

$ids = [];

$response = $engine->request('task/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $receivedTask) {
    expect_received_task_object($engine, "[$i]", $receivedTask);
    $ids[] = $receivedTask->id;
}

$response = $engine->request('task/received/get');
$engine->expectError('RECEIVED_TASK_NOT_FOUND');

$response = $engine->request('task/received/delete');
$engine->expectError('RECEIVED_TASK_NOT_FOUND');

foreach ($ids as $id) {

    $response = $engine->request('task/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_task_object($engine, '', $response);

    $response = $engine->request('task/received/delete', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

    $response = $engine->request('task/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_TASK_NOT_FOUND');

}

receive();

$response = $engine->request('task/received/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('task/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo "Done\n";
echo "$engine->numRequests requests made.\n";
