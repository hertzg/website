#!/usr/bin/php
<?php

function expect_contact_object ($engine, $variableName, $contact) {
    $properties = ['id', 'full_name', 'alias', 'address', 'email', 'phone1',
        'phone2', 'birthday_time', 'username', 'tags', 'favorite', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $contact);
    $engine->expectNatural("$variableName.id", $contact->id);
    $engine->expectType("$variableName.full_name", 'string', $contact->full_name);
    $engine->expectType("$variableName.alias", 'string', $contact->alias);
    $engine->expectType("$variableName.address", 'string', $contact->address);
    $engine->expectType("$variableName.email", 'string', $contact->email);
    $engine->expectType("$variableName.phone1", 'string', $contact->phone1);
    $engine->expectType("$variableName.phone2", 'string', $contact->phone2);
    $engine->expectType("$variableName.birthday_time", 'integer', $contact->birthday_time);
    $engine->expectType("$variableName.username", 'string', $contact->username);
    $engine->expectType("$variableName.tags", 'string', $contact->tags);
    $engine->expectType("$variableName.favorite", 'boolean', $contact->favorite);
    $engine->expectNatural("$variableName.insert_time", $contact->insert_time);
    $engine->expectNatural("$variableName.update_time", $contact->update_time);
}

$new_contact_full_name = 'sample full name '.rand();
$new_contact_alias = 'sample alias';
$new_contact_address = 'sample address';
$new_contact_email = 'sample email';
$new_contact_phone1 = 'sample phone1';
$new_contact_phone2 = 'sample phone2';
$new_contact_birthday_time = time() - 1000;
$new_contact_username = 'sample username';
$new_contact_tags = 'tag1 tag2';
$new_contact_favorite = true;

$edited_contact_full_name = 'edited full name'.rand();
$edited_contact_alias = 'edited alias';
$edited_contact_address = 'edited address';
$edited_contact_email = 'edited email';
$edited_contact_phone1 = 'edited phone1';
$edited_contact_phone2 = 'edited phone2';
$edited_contact_birthday_time = time();
$edited_contact_username = 'edited username';
$edited_contact_tags = 'tag1 tag2 tag3';
$edited_contact_favorite = false;

$manyTags = 'a b c d e f';

include_once 'classes/Engine.php';
$engine = new Engine;

$response = $engine->request('contact/add');
$engine->expectError('ENTER_FULL_NAME');

$response = $engine->request('contact/add', [
    'full_name' => $new_contact_full_name,
    'alias' => $new_contact_alias,
    'address' => $new_contact_address,
    'email' => $new_contact_email,
    'phone1' => $new_contact_phone1,
    'phone2' => $new_contact_phone2,
    'birthday_time' => $new_contact_birthday_time,
    'username' => $new_contact_username,
    'tags' => $manyTags,
    'favorite' => $new_contact_favorite,
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('contact/add', [
    'full_name' => $new_contact_full_name,
    'alias' => $new_contact_alias,
    'address' => $new_contact_address,
    'email' => $new_contact_email,
    'phone1' => $new_contact_phone1,
    'phone2' => $new_contact_phone2,
    'birthday_time' => $new_contact_birthday_time,
    'username' => $new_contact_username,
    'tags' => $new_contact_tags,
    'favorite' => $new_contact_favorite,
]);
$engine->expectStatus(200);
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('contact/get');
$engine->expectError('CONTACT_NOT_FOUND');

$response = $engine->request('contact/get', ['id' => $id]);
$engine->expectStatus(200);
expect_contact_object($engine, '', $response);
$engine->expectValue('.full_name', $new_contact_full_name, $response->full_name);
$engine->expectValue('.alias', $new_contact_alias, $response->alias);
$engine->expectValue('.address', $new_contact_address, $response->address);
$engine->expectValue('.email', $new_contact_email, $response->email);
$engine->expectValue('.phone1', $new_contact_phone1, $response->phone1);
$engine->expectValue('.phone2', $new_contact_phone2, $response->phone2);
$engine->expectValue('.birthday_time', $new_contact_birthday_time, $response->birthday_time);
$engine->expectValue('.username', $new_contact_username, $response->username);
$engine->expectValue('.tags', $new_contact_tags, $response->tags);
$engine->expectValue('.favorite', $new_contact_favorite, $response->favorite);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('contact/edit');
$engine->expectError('CONTACT_NOT_FOUND');

$response = $engine->request('contact/edit', ['id' => $id]);
$engine->expectError('ENTER_FULL_NAME');

$response = $engine->request('contact/edit', [
    'id' => $id,
    'full_name' => $edited_contact_full_name,
    'alias' => $edited_contact_alias,
    'address' => $edited_contact_address,
    'email' => $edited_contact_email,
    'phone1' => $edited_contact_phone1,
    'phone2' => $edited_contact_phone2,
    'birthday_time' => $edited_contact_birthday_time,
    'username' => $edited_contact_username,
    'tags' => $manyTags,
    'favorite' => $edited_contact_favorite,
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('contact/edit', [
    'id' => $id,
    'full_name' => $edited_contact_full_name,
    'alias' => $edited_contact_alias,
    'address' => $edited_contact_address,
    'email' => $edited_contact_email,
    'phone1' => $edited_contact_phone1,
    'phone2' => $edited_contact_phone2,
    'birthday_time' => $edited_contact_birthday_time,
    'username' => $edited_contact_username,
    'tags' => $edited_contact_tags,
    'favorite' => $edited_contact_favorite,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('contact/get', ['id' => $id]);
expect_contact_object($engine, '', $response);
$engine->expectValue('.full_name', $edited_contact_full_name, $response->full_name);
$engine->expectValue('.alias', $edited_contact_alias, $response->alias);
$engine->expectValue('.address', $edited_contact_address, $response->address);
$engine->expectValue('.email', $edited_contact_email, $response->email);
$engine->expectValue('.phone1', $edited_contact_phone1, $response->phone1);
$engine->expectValue('.phone2', $edited_contact_phone2, $response->phone2);
$engine->expectValue('.birthday_time', $edited_contact_birthday_time, $response->birthday_time);
$engine->expectValue('.username', $edited_contact_username, $response->username);
$engine->expectValue('.tags', $edited_contact_tags, $response->tags);
$engine->expectValue('.favorite', $edited_contact_favorite, $response->favorite);

$response = $engine->request('contact/list');
$engine->expectStatus(200);
$engine->expectType('', 'array', $response);
foreach ($response as $i => $contact) {
    expect_contact_object($engine, ".[$i]", $contact);
}

$response = $engine->request('contact/delete');
$engine->expectError('CONTACT_NOT_FOUND');

$response = $engine->request('contact/delete', ['id' => $id]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('contact/delete', ['id' => $id]);
$engine->expectError('CONTACT_NOT_FOUND');

echo "Done\n";
echo "$engine->numRequests requests made.\n";
