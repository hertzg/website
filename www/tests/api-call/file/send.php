#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$tempName = sys_get_temp_dir().'/test_'.rand();
file_put_contents($tempName, 'test content '.rand());
$file = new CURLFile($tempName);

$nonExistingUsername = 'non-existing-username';
$deniedUsername = 'giorgi';
$allowedUsername = 'angeli';
$name = 'sample name';

$response = $engine->request('file/send', [
    'receiver_username' => $nonExistingUsername,
]);
$engine->expectError('RECEIVER_NOT_FOUND');

$response = $engine->request('file/send', [
    'receiver_username' => $deniedUsername,
]);
$engine->expectError('RECEIVER_NOT_RECEIVING');

$response = $engine->request('file/send', [
    'receiver_username' => $allowedUsername,
    'name' => $name,
]);
$engine->expectError('SELECT_FILE');

$response = $engine->request('file/send', [
    'receiver_username' => $allowedUsername,
    'name' => $name,
    'file' => $file,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

unlink($tempName);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
