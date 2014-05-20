#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive();

$response = $engine->request('task/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_task_object.php';
foreach ($response as $i => $receivedTask) {

    expect_received_task_object($engine, "[$i]", $receivedTask);

    $id = $receivedTask->id;
    $text = $receivedTask->text;
    $tags = $receivedTask->tags;

    $response = $engine->request('task/received/import', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectNatural('', $response);

    $task_id = $response;

    $response = $engine->request('task/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_TASK_NOT_FOUND');

    $response = $engine->request('task/get', [
        'id' => $task_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('.text', $text, $response->text);
    $engine->expectValue('.tags', $tags, $response->tags);

    $response = $engine->request('task/delete', [
        'id' => $task_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

}

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
