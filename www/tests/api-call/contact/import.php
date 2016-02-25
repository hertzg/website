#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

function expect_imported ($engine, $receivedContact, $response) {
    include_once 'fns/expect_contact_object.php';
    expect_contact_object($engine, '', $response);
    $engine->expectValue('.full_name',
        $receivedContact->full_name, $response->full_name);
    $engine->expectValue('.alias', $receivedContact->alias, $response->alias);
    $engine->expectValue('.address',
        $receivedContact->address, $response->address);
    $engine->expectValue('.email1',
        $receivedContact->email1, $response->email1);
    $engine->expectValue('.email1_label',
        $receivedContact->email1_label, $response->email1_label);
    $engine->expectValue('.email2',
        $receivedContact->email2, $response->email2);
    $engine->expectValue('.email2_label',
        $receivedContact->email2_label, $response->email2_label);
    $engine->expectValue('.phone1',
        $receivedContact->phone1, $response->phone1);
    $engine->expectValue('.phone1_label',
        $receivedContact->phone1_label, $response->phone1_label);
    $engine->expectValue('.phone2',
        $receivedContact->phone2, $response->phone2);
    $engine->expectValue('.phone2_label',
        $receivedContact->phone2_label, $response->phone2_label);
    $engine->expectValue('.birthday_time',
        $receivedContact->birthday_time, $response->birthday_time);
    $engine->expectValue('.username',
        $receivedContact->username, $response->username);
    $engine->expectValue('.timezone',
        $receivedContact->timezone, $response->timezone);
    $engine->expectValue('.tags', $receivedContact->tags, $response->tags);
    $engine->expectValue('.notes', $receivedContact->notes, $response->notes);
    $engine->expectValue('.favorite',
        $receivedContact->favorite, $response->favorite);
}

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive($engine->numRequests);

$response = $engine->request('contact/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_contact_object.php';
foreach ($response as $i => $receivedContact) {

    expect_received_contact_object($engine, "[$i]", $receivedContact);

    $id = $receivedContact->id;

    $response = $engine->request('contact/received/importCopy', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectNatural('', $response);

    $contact_id = $response;

    $response = $engine->request('contact/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_contact_object($engine, '', $response);

    $response = $engine->request('contact/get', [
        'id' => $contact_id,
    ]);
    $engine->expectSuccess();
    expect_imported($engine, $receivedContact, $response);

    $response = $engine->request('contact/received/import', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectNatural('', $response);

    $contact_id = $response;

    $response = $engine->request('contact/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_CONTACT_NOT_FOUND');

    $response = $engine->request('contact/get', [
        'id' => $contact_id,
    ]);
    $engine->expectSuccess();
    expect_imported($engine, $receivedContact, $response);

    $response = $engine->request('contact/delete', [
        'id' => $contact_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

}

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
