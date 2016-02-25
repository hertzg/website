#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

function expect_imported ($engine, $receivedTask, $response) {
    include_once 'fns/expect_task_object.php';
    expect_task_object($engine, '', $response);
    $engine->expectValue('.text', $receivedTask->text, $response->text);
    $engine->expectValue('.tags', $receivedTask->tags, $response->tags);
}

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive($engine->numRequests);

$response = $engine->request('task/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_task_object.php';
foreach ($response as $i => $receivedTask) {

    expect_received_task_object($engine, "[$i]", $receivedTask);

    $id = $receivedTask->id;

    $response = $engine->request('task/received/importCopy', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectNatural('', $response);

    $task_id = $response;

    $response = $engine->request('task/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_task_object($engine, "[$i]", $response);

    $response = $engine->request('task/get', [
        'id' => $task_id,
    ]);
    $engine->expectSuccess();
    expect_imported($engine, $receivedTask, $response);

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
    expect_imported($engine, $receivedTask, $response);

    $response = $engine->request('task/delete', [
        'id' => $task_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

}

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
