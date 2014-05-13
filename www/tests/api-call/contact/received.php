#!/usr/bin/php
<?php

function expect_received_contact_object ($engine, $variableName, $receivedContact) {
    $properties = ['id', 'sender_username', 'full_name', 'alias', 'address',
        'email', 'phone1', 'phone2', 'birthday_time', 'username', 'tags',
        'favorite', 'tags', 'insert_time'];
    $engine->expectObject($variableName, $properties, $receivedContact);
    $engine->expectNatural("$variableName.id", $receivedContact->id);
    $engine->expectType("$variableName.sender_username", 'string',
        $receivedContact->sender_username);
    $engine->expectType("$variableName.full_name", 'string', $receivedContact->full_name);
    $engine->expectType("$variableName.alias", 'string', $receivedContact->alias);
    $engine->expectType("$variableName.address", 'string', $receivedContact->address);
    $engine->expectType("$variableName.email", 'string', $receivedContact->email);
    $engine->expectType("$variableName.phone1", 'string', $receivedContact->phone1);
    $engine->expectType("$variableName.phone2", 'string', $receivedContact->phone2);
    $engine->expectType("$variableName.birthday_time",
        'integer', $receivedContact->birthday_time);
    $engine->expectType("$variableName.username", 'string', $receivedContact->username);
    $engine->expectType("$variableName.tags", 'string', $receivedContact->tags);
    $engine->expectType("$variableName.favorite", 'boolean', $receivedContact->favorite);
    $engine->expectType("$variableName.tags", 'string', $receivedContact->tags);
    $engine->expectNatural("$variableName.insert_time", $receivedContact->insert_time);
}

function receive () {
    $engine = new Engine;
    $engine->api_key = '6dd831e2f696691091a36b5b4d400e6af6a4fe4c68d3ab2727432338a258144d';
    $engine->request('contact/send', [
        'full_name' => 'sample full_name',
        'alias' => 'sample alias',
        'address' => 'sample address',
        'email' => 'sample email',
        'phone1' => 'sample phone1',
        'phone2' => 'sample phone2',
        'birthday_time' => 0,
        'username' => 'sample username',
        'tags' => 'tag1 tag2',
        'favorite' => true,
        'receiver_username' => 'aimnadze',
    ]);
    $engine->expectSuccess();
}

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

receive();

$ids = [];

$response = $engine->request('contact/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $receivedContact) {
    expect_received_contact_object($engine, "[$i]", $receivedContact);
    $ids[] = $receivedContact->id;
}

$response = $engine->request('contact/received/get');
$engine->expectError('RECEIVED_CONTACT_NOT_FOUND');

$response = $engine->request('contact/received/delete');
$engine->expectError('RECEIVED_CONTACT_NOT_FOUND');

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

receive();

$response = $engine->request('contact/received/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('contact/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo "Done\n";
echo "$engine->numRequests requests made.\n";
