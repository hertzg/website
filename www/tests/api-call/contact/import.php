#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive();

$response = $engine->request('contact/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_contact_object.php';
foreach ($response as $i => $receivedContact) {

    expect_received_contact_object($engine, "[$i]", $receivedContact);

    $id = $receivedContact->id;
    $full_name = $receivedContact->full_name;
    $alias = $receivedContact->alias;
    $address = $receivedContact->address;
    $email = $receivedContact->email;
    $phone1 = $receivedContact->phone1;
    $phone2 = $receivedContact->phone2;
    $birthday_time = $receivedContact->birthday_time;
    $username = $receivedContact->username;
    $tags = $receivedContact->tags;
    $favorite = $receivedContact->favorite;
    $tags = $receivedContact->tags;

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
    $engine->expectValue('.full_name', $full_name, $response->full_name);
    $engine->expectValue('.alias', $alias, $response->alias);
    $engine->expectValue('.address', $address, $response->address);
    $engine->expectValue('.email', $email, $response->email);
    $engine->expectValue('.phone1', $phone1, $response->phone1);
    $engine->expectValue('.phone2', $phone2, $response->phone2);
    $engine->expectValue('.birthday_time', $birthday_time, $response->birthday_time);
    $engine->expectValue('.username', $username, $response->username);
    $engine->expectValue('.tags', $tags, $response->tags);
    $engine->expectValue('.favorite', $favorite, $response->favorite);

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
    $engine->expectValue('.full_name', $full_name, $response->full_name);
    $engine->expectValue('.alias', $alias, $response->alias);
    $engine->expectValue('.address', $address, $response->address);
    $engine->expectValue('.email', $email, $response->email);
    $engine->expectValue('.phone1', $phone1, $response->phone1);
    $engine->expectValue('.phone2', $phone2, $response->phone2);
    $engine->expectValue('.birthday_time', $birthday_time, $response->birthday_time);
    $engine->expectValue('.username', $username, $response->username);
    $engine->expectValue('.tags', $tags, $response->tags);
    $engine->expectValue('.favorite', $favorite, $response->favorite);

    $response = $engine->request('contact/delete', [
        'id' => $contact_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

}

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
