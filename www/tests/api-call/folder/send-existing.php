#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$nonExistingUsername = 'non-existing-username';
$deniedUsername = 'giorgi';
$allowedUsername = 'angeli';
$name = 'sample name';

$response = $engine->request('folder/add', [
    'name' => $name,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('folder/sendExisting', [
    'id' => $id,
    'receiver_username' => $nonExistingUsername,
]);
$engine->expectError('RECEIVER_NOT_FOUND');

$response = $engine->request('folder/sendExisting', [
    'id' => $id,
    'receiver_username' => $deniedUsername,
]);
$engine->expectError('RECEIVER_NOT_RECEIVING');

$response = $engine->request('folder/sendExisting', [
    'id' => $id,
    'receiver_username' => $allowedUsername,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('folder/delete', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
