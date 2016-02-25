#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once '../../../fns/time_today.php';
$event_time = time_today();

$text = 'sample text';
$start_hour = 10;
$start_minute = 15;

$response = $engine->request('event/add', [
    'text' => $text,
    'event_time' => $event_time,
    'start_hour' => $start_hour,
    'start_minute' => $start_minute,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

include_once 'fns/expect_event_object.php';
$response = $engine->request('event/get', ['id' => $id]);
$engine->expectSuccess();
expect_event_object($engine, '', $response);
$engine->expectValue('.text', $text, $response->text);
$engine->expectValue('.event_time', $event_time, $response->event_time);
$engine->expectValue('.start_hour', $start_hour, $response->start_hour);
$engine->expectValue('.start_minute', $start_minute, $response->start_minute);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('event/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $event) {
    expect_event_object($engine, "[$i]", $event);
}

$response = $engine->request('event/delete', ['id' => $id]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('event/delete', ['id' => $id]);
$engine->expectError('EVENT_NOT_FOUND');

$response = $engine->request('event/add', [
    'text' => $text,
    'event_time' => $event_time,
    'start_hour' => $start_hour,
    'start_minute' => $start_minute,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$response = $engine->request('event/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('event/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
