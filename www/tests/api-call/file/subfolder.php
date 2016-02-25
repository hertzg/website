#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once 'fns/expect_file_object.php';

$tempName = sys_get_temp_dir().'/test_'.rand();
file_put_contents($tempName, 'test content '.rand());
$file = new CURLFile($tempName);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$new_name = 'test file name';

$response = $engine->request('folder/add', [
    'name' => 'tert folder name',
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$parent_id = $response;

$response = $engine->request('file/add', [
    'name' => $new_name,
    'file' => $file,
    'parent_id' => $parent_id,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('file/list', [
    'parent_id' => $parent_id,
]);
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $file) {
    expect_file_object($engine, "[$i]", $file);
}

$response = $engine->request('folder/delete', [
    'id' => $parent_id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

unset($tempName);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
