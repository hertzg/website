#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once '../../../fns/time_today.php';
$response = $engine->request('event/add', [
    'text' => 'sample text',
    'event_time' => time_today() - 60 * 60 * 24,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('event/edit', ['id' => $id]);
$engine->expectError('ENTER_TEXT');

$text = 'edited text';
$event_time = time_today();

$response = $engine->request('event/edit', [
    'id' => $id,
    'text' => $text,
    'event_time' => $event_time,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

include_once 'fns/expect_event_object.php';
$response = $engine->request('event/get', ['id' => $id]);
expect_event_object($engine, '', $response);
$engine->expectValue('.text', $text, $response->text);
$engine->expectValue('.event_time', $event_time, $response->event_time);

$response = $engine->request('event/delete', ['id' => $id]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
