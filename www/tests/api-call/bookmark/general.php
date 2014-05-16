#!/usr/bin/php
<?php

chdir(__DIR__);

include_once 'fns/expect_bookmark_object.php';

$new_bookmark_url = 'sample bookmark url';
$new_bookmark_title = 'sample bookmark title';
$new_bookmark_tags = 'tag1 tag2';

$manyTags = 'a b c d e f';

include_once '../classes/Engine.php';
$engine = new Engine;

$response = $engine->request('bookmark/add', [
    'url' => $new_bookmark_url,
    'title' => $new_bookmark_title,
    'tags' => $manyTags,
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('bookmark/add', [
    'url' => $new_bookmark_url,
    'title' => $new_bookmark_title,
    'tags' => $new_bookmark_tags,
]);
$engine->expectSuccess();
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('bookmark/get', ['id' => $id]);
$engine->expectSuccess();
expect_bookmark_object($engine, '', $response);
$engine->expectValue('.url', $new_bookmark_url, $response->url);
$engine->expectValue('.title', $new_bookmark_title, $response->title);
$engine->expectValue('.tags', $new_bookmark_tags, $response->tags);
$engine->expectEquals('.insert_time', '.update_time',
    $response->insert_time, $response->update_time);

$response = $engine->request('bookmark/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $bookmark) {
    expect_bookmark_object($engine, ".[$i]", $bookmark);
}

$response = $engine->request('bookmark/delete', ['id' => $id]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('bookmark/delete', ['id' => $id]);
$engine->expectError('BOOKMARK_NOT_FOUND');

$response = $engine->request('bookmark/add', [
    'url' => $new_bookmark_url,
    'title' => $new_bookmark_title,
    'tags' => $new_bookmark_tags,
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

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
