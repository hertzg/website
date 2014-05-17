#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$nonExistingUsername = 'non-existing-username';
$deniedUsername = 'giorgi';
$allowedUsername = 'angeli';
$text = 'sample text';

$response = $engine->request('note/add', [
    'text' => $text,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('note/sendExisting', [
    'id' => $id,
    'receiver_username' => $nonExistingUsername,
]);
$engine->expectError('RECEIVER_NOT_FOUND');

$response = $engine->request('note/sendExisting', [
    'id' => $id,
    'receiver_username' => $deniedUsername,
]);
$engine->expectError('RECEIVER_NOT_RECEIVING');

$response = $engine->request('note/sendExisting', [
    'id' => $id,
    'receiver_username' => $allowedUsername,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('note/delete', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
