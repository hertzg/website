#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$url = 'sample url';
$title = 'sample title';
$tags = 'sample tags';

$response = $engine->request('bookmark/add', [
    'url' => $url,
    'tags' => 'a b c d e f',
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('bookmark/add', [
    'url' => $url,
    'title' => $title,
    'tags' => $tags,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

include_once 'fns/expect_bookmark_object.php';
$response = $engine->request('bookmark/get', ['id' => $id]);
$engine->expectSuccess();
expect_bookmark_object($engine, '', $response);
$engine->expectValue('.url', $url, $response->url);
$engine->expectValue('.title', $title, $response->title);
$engine->expectValue('.tags', $tags, $response->tags);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('bookmark/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $bookmark) {
    expect_bookmark_object($engine, "[$i]", $bookmark);
}

$response = $engine->request('bookmark/delete', ['id' => $id]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('bookmark/delete', ['id' => $id]);
$engine->expectError('BOOKMARK_NOT_FOUND');

$response = $engine->request('bookmark/add', [
    'url' => $url,
    'title' => $title,
    'tags' => $tags,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$response = $engine->request('bookmark/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('bookmark/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
