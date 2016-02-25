#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive($engine->numRequests);

$ids = [];

$response = $engine->request('contact/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_contact_object.php';
foreach ($response as $i => $receivedContact) {
    expect_received_contact_object($engine, "[$i]", $receivedContact);
    $ids[] = $receivedContact->id;
}

foreach ($ids as $id) {

    $response = $engine->request('contact/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_contact_object($engine, '', $response);

    $response = $engine->request('contact/received/delete', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

    $response = $engine->request('contact/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_CONTACT_NOT_FOUND');

}

receive($engine->numRequests);

$response = $engine->request('contact/received/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('contact/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
