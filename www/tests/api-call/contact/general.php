#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once '../../../fns/time_today.php';
$birthday_time = time_today();

$full_name = 'sample full_name';
$alias = 'sample alias';
$address = 'sample address';
$email1 = 'sample email1';
$email1_label = 'sample email1_label';
$email2 = 'sample email2';
$email2_label = 'sample email2_label';
$phone1 = 'sample phone1';
$phone1_label = 'sample phone1_label';
$phone2 = 'sample phone2';
$phone2_label = 'sample phone2_label';
$username = 'sample username';
$timezone = -60;
$tags = 'tag1 tag2';
$notes = 'sample notes';
$favorite = true;

$response = $engine->request('contact/add', [
    'full_name' => $full_name,
    'tags' => 'a b c d e f',
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('contact/add', [
    'full_name' => $full_name,
    'alias' => $alias,
    'address' => $address,
    'email1' => $email1,
    'email1_label' => $email1_label,
    'email2' => $email2,
    'email2_label' => $email2_label,
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
$engine->expectNatural('', $response);

$id = $response;

include_once 'fns/expect_contact_object.php';
$response = $engine->request('contact/get', ['id' => $id]);
$engine->expectSuccess();
expect_contact_object($engine, '', $response);
$engine->expectValue('.full_name', $full_name, $response->full_name);
$engine->expectValue('.alias', $alias, $response->alias);
$engine->expectValue('.address', $address, $response->address);
$engine->expectValue('.email1', $email1, $response->email1);
$engine->expectValue('.email1_label', $email1_label, $response->email1_label);
$engine->expectValue('.email2', $email2, $response->email2);
$engine->expectValue('.email2_label', $email2_label, $response->email2_label);
$engine->expectValue('.phone1', $phone1, $response->phone1);
$engine->expectValue('.phone1_label', $phone1_label, $response->phone1_label);
$engine->expectValue('.phone2', $phone2, $response->phone2);
$engine->expectValue('.phone2_label', $phone2, $response->phone2_label);
$engine->expectValue('.birthday_time',
    $birthday_time, $response->birthday_time);
$engine->expectValue('.username', $username, $response->username);
$engine->expectValue('.timezone', $timezone, $response->timezone);
$engine->expectValue('.tags', $tags, $response->tags);
$engine->expectValue('.notes', $notes, $response->notes);
$engine->expectValue('.favorite', $favorite, $response->favorite);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('contact/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $contact) {
    expect_contact_object($engine, "[$i]", $contact);
}

$response = $engine->request('contact/delete', ['id' => $id]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('contact/delete', ['id' => $id]);
$engine->expectError('CONTACT_NOT_FOUND');

$response = $engine->request('contact/add', [
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
$engine->expectNatural('', $response);

$response = $engine->request('contact/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('contact/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
