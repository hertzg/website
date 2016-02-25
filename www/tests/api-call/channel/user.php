#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$nonExistingUsername = 'non-existing-username';
$invalidUsername = 'invld';
$selfUsername = 'aimnadze';
$deniedUsername = 'giorgi';
$allowedUsername = 'angeli';

$response = $engine->request('channel/add', [
    'channel_name' => 'new-channel-name',
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('channel/user/add', [
    'id' => $id,
]);
$engine->expectError('ENTER_USERNAME');

$response = $engine->request('channel/user/add', [
    'id' => $id,
    'username' => $nonExistingUsername,
]);
$engine->expectError('USER_NOT_FOUND');

$response = $engine->request('channel/user/add', [
    'id' => $id,
    'username' => $deniedUsername,
]);
$engine->expectError('USER_NOT_RECEIVING');

$response = $engine->request('channel/user/add', [
    'id' => $id,
    'username' => $selfUsername,
]);
$engine->expectError('USER_IS_SELF');

$response = $engine->request('channel/user/add', [
    'id' => $id,
    'username' => $invalidUsername,
]);
$engine->expectError('INVALID_USERNAME');

$response = $engine->request('channel/user/add', [
    'id' => $id,
    'username' => $allowedUsername,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('channel/user/add', [
    'id' => $id,
    'username' => $allowedUsername,
]);
$engine->expectError('USER_ALREADY_ADDED');

$response = $engine->request('channel/user/list', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $username) {
    $engine->expectType("[$i]", 'string', $username);
}

$response = $engine->request('channel/user/remove', [
    'id' => $id,
    'username' => $allowedUsername,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('channel/user/remove', [
    'id' => $id,
    'username' => $allowedUsername,
]);
$engine->expectError('USER_NOT_ADDED');

$response = $engine->request('channel/delete', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
