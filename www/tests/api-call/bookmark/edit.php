#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

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

$edited_url = 'edited url';
$edited_title = 'edited title';
$edited_tags = 'edited tags';

$response = $engine->request('bookmark/edit', [
    'id' => $id,
    'url' => $edited_url,
    'title' => $edited_title,
    'tags' => 'a b c d e f',
]);
$engine->expectError('TOO_MANY_TAGS');

$response = $engine->request('bookmark/edit', [
    'id' => $id,
    'url' => $edited_url,
    'title' => $edited_title,
    'tags' => $edited_tags,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('bookmark/get', ['id' => $id]);
$engine->expectSuccess();
include_once 'fns/expect_bookmark_object.php';
expect_bookmark_object($engine, '', $response);
$engine->expectValue('.url', $edited_url, $response->url);
$engine->expectValue('.title', $edited_title, $response->title);
$engine->expectValue('.tags', $edited_tags, $response->tags);

$response = $engine->request('bookmark/delete', [
    'id' => $id,
]);
$engine->expectSuccess();
$engine->expectValue('', true, $response);

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
