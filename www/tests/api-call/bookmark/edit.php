#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('bookmark/add', [
    'url' => 'sample url',
    'title' => 'sample title',
    'tags' => 'sample tags',
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('bookmark/edit', ['id' => $id]);
$engine->expectError('ENTER_URL');

$url = 'edited url';
$title = 'edited title';
$tags = 'edited tags';

$response = $engine->request('bookmark/edit', [
    'id' => $id,
    'url' => $url,
    'tags' => 'a b c d e f',
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('bookmark/edit', [
    'id' => $id,
    'url' => $url,
    'title' => $title,
    'tags' => $tags,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('bookmark/get', ['id' => $id]);
$engine->expectSuccess();
include_once 'fns/expect_bookmark_object.php';
expect_bookmark_object($engine, '', $response);
$engine->expectValue('.url', $url, $response->url);
$engine->expectValue('.title', $title, $response->title);
$engine->expectValue('.tags', $tags, $response->tags);

$response = $engine->request('bookmark/delete', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
