#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$nonExistingUsername = 'non-existing-username';
$deniedUsername = 'giorgi';
$allowedUsername = 'angeli';
$full_name = 'sample full_name';

$response = $engine->request('contact/add', [
    'full_name' => $full_name,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('contact/sendExisting', [
    'id' => $id,
    'receiver_username' => $nonExistingUsername,
]);
$engine->expectError('RECEIVER_NOT_FOUND');

$response = $engine->request('contact/sendExisting', [
    'id' => $id,
    'receiver_username' => $deniedUsername,
]);
$engine->expectError('RECEIVER_NOT_RECEIVING');

$response = $engine->request('contact/sendExisting', [
    'id' => $id,
    'receiver_username' => $allowedUsername,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('contact/delete', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
