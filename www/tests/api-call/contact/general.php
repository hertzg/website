#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$full_name = 'sample full_name';
$alias = 'sample alias';
$address = 'sample address';
$email = 'sample email';
$phone1 = 'sample phone1';
$phone2 = 'sample phone2';
$birthday_time = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
$username = 'sample username';
$tags = 'tag1 tag2';
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
    'email' => $email,
    'phone1' => $phone1,
    'phone2' => $phone2,
    'birthday_time' => $birthday_time,
    'username' => $username,
    'tags' => $tags,
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
$engine->expectValue('.email', $email, $response->email);
$engine->expectValue('.phone1', $phone1, $response->phone1);
$engine->expectValue('.phone2', $phone2, $response->phone2);
$engine->expectValue('.birthday_time',
    $birthday_time, $response->birthday_time);
$engine->expectValue('.username', $username, $response->username);
$engine->expectValue('.tags', $tags, $response->tags);
$engine->expectValue('.favorite', $favorite, $response->favorite);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('contact/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $contact) {
    expect_contact_object($engine, ".[$i]", $contact);
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
    'phone2' => $phone2,
    'birthday_time' => $birthday_time,
    'username' => $username,
    'tags' => $tags,
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

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
