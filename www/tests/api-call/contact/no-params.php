#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('contact/add');
$engine->expectError('ENTER_FULL_NAME');

$response = $engine->request('contact/delete');
$engine->expectError('CONTACT_NOT_FOUND');

$response = $engine->request('contact/edit');
$engine->expectError('CONTACT_NOT_FOUND');

$response = $engine->request('contact/get');
$engine->expectError('CONTACT_NOT_FOUND');

$response = $engine->request('contact/received/delete');
$engine->expectError('RECEIVED_CONTACT_NOT_FOUND');

$response = $engine->request('contact/received/get');
$engine->expectError('RECEIVED_CONTACT_NOT_FOUND');

$response = $engine->request('contact/received/import');
$engine->expectError('RECEIVED_CONTACT_NOT_FOUND');

$response = $engine->request('contact/received/importCopy');
$engine->expectError('RECEIVED_CONTACT_NOT_FOUND');

$response = $engine->request('contact/send');
$engine->expectError('ENTER_RECEIVER_USERNAME');

$response = $engine->request('contact/sendExisting');
$engine->expectError('CONTACT_NOT_FOUND');

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
