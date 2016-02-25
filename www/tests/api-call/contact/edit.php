#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('contact/add', [
    'full_name' => 'sample full_name',
    'alias' => 'sample alias',
    'address' => 'sample address',
    'email1' => 'sample email1',
    'email1_label' => 'sample email1_label',
    'email2' => 'sample email2',
    'email2_label' => 'sample email2_label',
    'phone1' => 'sample phone1',
    'phone1_label' => 'sample phone1_label',
    'phone2' => 'sample phone2',
    'phone2_label' => 'sample phone2_label',
    'birthday_time' => null,
    'username' => 'sample username',
    'tags' => 'sample tags',
    'notes' => 'sample notes',
    'favorite' => false,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('contact/edit', ['id' => $id]);
$engine->expectError('ENTER_FULL_NAME');

$full_name = 'edited full_name';
$alias = 'edited alias';
$address = 'edited address';
$email1 = 'edited email1';
$email1_label = 'edited email1_label';
$email2 = 'edited email2';
$email2_label = 'edited email2_label';
$phone1 = 'edited phone1';
$phone1_label = 'edited phone1_label';
$phone2 = 'edited phone2';
$phone2_label = 'edited phone2_label';
$birthday_time = 24 * 60 * 60;
$username = 'edited username';
$timezone = 60;
$tags = 'edited tags';
$notes = 'edited notes';
$favorite = true;

$response = $engine->request('contact/edit', [
    'id' => $id,
    'full_name' => $full_name,
    'tags' => 'a b c d e f',
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('contact/edit', [
    'id' => $id,
    'full_name' => $full_name,
    'alias' => $alias,
    'address' => $address,
    'email' => $email,
    'phone1' => $phone1,
    'phone1_label' => $phone1_label,
    'phone2' => $phone2,
    'phone2_label' => $phone2_label,
    'birthday_time' => $birthday_time,
    'username' => $username,
    'timezone' => $timezone,
    'tags' => $tags,
    'notes' => $notes,
    'favorite' => $favorite,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

include_once 'fns/expect_contact_object.php';
$response = $engine->request('contact/get', ['id' => $id]);
expect_contact_object($engine, '', $response);
$engine->expectValue('.full_name', $full_name, $response->full_name);
$engine->expectValue('.alias', $alias, $response->alias);
$engine->expectValue('.address', $address, $response->address);
$engine->expectValue('.email', $email, $response->email);
$engine->expectValue('.phone1', $phone1, $response->phone1);
$engine->expectValue('.phone1_label', $phone1_label, $response->phone1_label);
$engine->expectValue('.phone2', $phone2, $response->phone2);
$engine->expectValue('.phone2_label', $phone2_label, $response->phone2_label);
$engine->expectValue('.birthday_time',
    $birthday_time, $response->birthday_time);
$engine->expectValue('.username', $username, $response->username);
$engine->expectValue('.timezone', $timezone, $response->timezone);
$engine->expectValue('.tags', $tags, $response->tags);
$engine->expectValue('.notes', $notes, $response->notes);
$engine->expectValue('.favorite', $favorite, $response->favorite);

$response = $engine->request('contact/delete', ['id' => $id]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
