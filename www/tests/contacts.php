#!/usr/bin/php
<?php

function expect_contact_object ($engine, $variableName, $contact) {
    $properties = ['id', 'full_name', 'tags', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $contact);
    $engine->expectNatural("$variableName.id", $contact->id);
    $engine->expectType("$variableName.full_name", 'string', $contact->full_name);
    $engine->expectType("$variableName.tags", 'string', $contact->tags);
    $engine->expectNatural("$variableName.insert_time", $contact->insert_time);
    $engine->expectNatural("$variableName.update_time", $contact->update_time);
}

$new_contact_full_name = 'sample full name '.rand();
$new_contact_tags = 'tag1 tag2';

$edited_contact_full_name = 'edited full name'.rand();
$edited_contact_tags = 'tag1 tag2 tag3';

$manyTags = 'a b c d e f';

include_once 'classes/Engine.php';
$engine = new Engine;

$response = $engine->request('contact/add');
$engine->expectStatus(400);
$engine->expectError('ENTER_FULL_NAME', $response);

$response = $engine->request('contact/add', [
    'full_name' => $new_contact_full_name,
    'tags' => $manyTags,
]);
$engine->expectStatus(400);
$engine->expectError('TOO_MANY_TAGS', $response);

$response = $engine->request('contact/add', [
    'full_name' => $new_contact_full_name,
    'tags' => $new_contact_tags,
]);
$engine->expectStatus(200);
$engine->expectObject('', ['id'], $response);
$engine->expectNatural('.id', $response->id);

$id = $response->id;

$response = $engine->request('contact/get');
$engine->expectStatus(400);
$engine->expectError('CONTACT_NOT_FOUND', $response);

$contact = $engine->request('contact/get', ['id' => $id]);
$engine->expectStatus(200);
expect_contact_object($engine, '', $contact);
$engine->expectValue('.full_name', $new_contact_full_name, $contact->full_name);
$engine->expectValue('.tags', $new_contact_tags, $contact->tags);
$engine->expectEquals('.insert_time', '.update_time', $contact->insert_time, $contact->update_time);

$response = $engine->request('contact/edit');
$engine->expectStatus(400);
$engine->expectError('CONTACT_NOT_FOUND', $response);

$response = $engine->request('contact/edit', ['id' => $id]);
$engine->expectStatus(400);
$engine->expectError('ENTER_FULL_NAME', $response);

$response = $engine->request('contact/edit', [
    'id' => $id,
    'full_name' => $edited_contact_full_name,
    'tags' => $manyTags,
]);
$engine->expectStatus(400);
$engine->expectError('TOO_MANY_TAGS', $response);

$response = $engine->request('contact/edit', [
    'id' => $id,
    'full_name' => $edited_contact_full_name,
    'tags' => $edited_contact_tags,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$contact = $engine->request('contact/get', ['id' => $id]);
expect_contact_object($engine, '', $contact);
$engine->expectValue('.full_name', $edited_contact_full_name, $contact->full_name);
$engine->expectValue('.tags', $edited_contact_tags, $contact->tags);

$contacts = $engine->request('contact/list');
$engine->expectStatus(200);
$engine->expectType('', 'array', $contacts);
foreach ($contacts as $i => $contact) {
    expect_contact_object($engine, ".[$i]", $contact);
}

$response = $engine->request('contact/delete');
$engine->expectStatus(400);
$engine->expectError('CONTACT_NOT_FOUND', $response);

$response = $engine->request('contact/delete', ['id' => $id]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('contact/delete', ['id' => $id]);
$engine->expectStatus(400);
$engine->expectError('CONTACT_NOT_FOUND', $response);

echo "Done\n";
echo "$engine->numRequests requests made.\n";
