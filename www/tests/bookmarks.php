#!/usr/bin/php
<?php

function expect_bookmark_object ($engine, $variableName, $bookmark) {
    $properties = ['id', 'url', 'title', 'tags', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $bookmark);
    $engine->expectNatural("$variableName.id", $bookmark->id);
    $engine->expectType("$variableName.url", 'string', $bookmark->url);
    $engine->expectType("$variableName.title", 'string', $bookmark->title);
    $engine->expectType("$variableName.tags", 'string', $bookmark->tags);
    $engine->expectNatural("$variableName.insert_time", $bookmark->insert_time);
    $engine->expectNatural("$variableName.update_time", $bookmark->update_time);
}

$new_bookmark_url = 'sample bookmark url';
$new_bookmark_title = 'sample bookmark title';
$new_bookmark_tags = 'tag1 tag2';

$edited_bookmark_url = 'edited url';
$edited_bookmark_title = 'edited title';
$edited_bookmark_tags = 'tag1 tag2 tag3';

$manyTags = 'a b c d e f';

include_once 'classes/Engine.php';
$engine = new Engine;

$response = $engine->request('bookmark/add');
$engine->expectStatus(400);
$engine->expectValue('', 'ENTER_URL', $response);

$response = $engine->request('bookmark/add', [
    'url' => $new_bookmark_url,
    'title' => $new_bookmark_title,
    'tags' => $manyTags,
]);
$engine->expectStatus(400);
$engine->expectValue('', 'TOO_MANY_TAGS', $response);

$response = $engine->request('bookmark/add', [
    'url' => $new_bookmark_url,
    'title' => $new_bookmark_title,
    'tags' => $new_bookmark_tags,
]);
$engine->expectStatus(200);
$engine->expectNatural('', $response);

$id = $response;

$response = $engine->request('bookmark/get');
$engine->expectStatus(400);
$engine->expectValue('', 'BOOKMARK_NOT_FOUND', $response);

$bookmark = $engine->request('bookmark/get', ['id' => $id]);
$engine->expectStatus(200);
expect_bookmark_object($engine, '', $bookmark);
$engine->expectValue('.url', $new_bookmark_url, $bookmark->url);
$engine->expectValue('.title', $new_bookmark_title, $bookmark->title);
$engine->expectValue('.tags', $new_bookmark_tags, $bookmark->tags);
$engine->expectEquals('.insert_time', '.update_time', $bookmark->insert_time, $bookmark->update_time);

$response = $engine->request('bookmark/edit');
$engine->expectStatus(400);
$engine->expectValue('', 'BOOKMARK_NOT_FOUND', $response);

$response = $engine->request('bookmark/edit', ['id' => $id]);
$engine->expectStatus(400);
$engine->expectValue('', 'ENTER_URL', $response);

$response = $engine->request('bookmark/edit', [
    'id' => $id,
    'url' => $edited_bookmark_url,
    'title' => $edited_bookmark_title,
    'tags' => $manyTags,
]);
$engine->expectStatus(400);
$engine->expectValue('', 'TOO_MANY_TAGS', $response);

$response = $engine->request('bookmark/edit', [
    'id' => $id,
    'url' => $edited_bookmark_url,
    'title' => $edited_bookmark_title,
    'tags' => $edited_bookmark_tags,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$bookmark = $engine->request('bookmark/get', ['id' => $id]);
expect_bookmark_object($engine, '', $bookmark);
$engine->expectValue('.url', $edited_bookmark_url, $bookmark->url);
$engine->expectValue('.title', $edited_bookmark_title, $bookmark->title);
$engine->expectValue('.tags', $edited_bookmark_tags, $bookmark->tags);

$bookmarks = $engine->request('bookmark/list');
$engine->expectStatus(200);
$engine->expectType('', 'array', $bookmarks);
foreach ($bookmarks as $i => $bookmark) {
    expect_bookmark_object($engine, ".[$i]", $bookmark);
}

$response = $engine->request('bookmark/delete');
$engine->expectStatus(400);
$engine->expectValue('', 'BOOKMARK_NOT_FOUND', $response);

$response = $engine->request('bookmark/delete', ['id' => $id]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('bookmark/delete', ['id' => $id]);
$engine->expectStatus(400);
$engine->expectValue('', 'BOOKMARK_NOT_FOUND', $response);

echo "Done\n";
echo "$engine->numRequests requests made.\n";
