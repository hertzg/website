#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$response = $engine->request('contact/add');
$engine->expectError('ENTER_FULL_NAME');

$response = $engine->request('contact/delete');
$engine->expectError('CONTACT_NOT_FOUND');

$response = $engine->request('contact/edit');
$engine->expectError('CONTACT_NOT_FOUND');

$response = $engine->request('contact/get');
$engine->expectError('CONTACT_NOT_FOUND');

$response = $engine->request('contact/send');
$engine->expectError('ENTER_RECEIVER_USERNAME');

$response = $engine->request('contact/received/get');
$engine->expectError('RECEIVED_CONTACT_NOT_FOUND');

$response = $engine->request('contact/received/delete');
$engine->expectError('RECEIVED_CONTACT_NOT_FOUND');

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
