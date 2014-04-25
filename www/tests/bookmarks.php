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

$newBookmarkUrl = 'sample bookmark url';
$newBookmarkTitle = 'sample bookmark title';
$newBookmarkTags = 'tag1 tag2';
$editedBookmarkUrl = 'edited url';
$editedBookmarkTitle = 'edited title';
$editedBookmarkTags = 'tag1 tag2 tag3';
$manyTags = 'a b c d e f';

include_once 'classes/Engine.php';
$engine = new Engine;

$response = $engine->request('bookmark/add');
$engine->expectStatus(400);
$engine->expectError('ENTER_URL', $response);

$response = $engine->request('bookmark/add', [
    'url' => $newBookmarkUrl,
    'title' => $newBookmarkTitle,
    'tags' => $manyTags,
]);
$engine->expectStatus(400);
$engine->expectError('TOO_MANY_TAGS', $response);

$response = $engine->request('bookmark/add', [
    'url' => $newBookmarkUrl,
    'title' => $newBookmarkTitle,
    'tags' => $newBookmarkTags,
]);
$engine->expectStatus(200);
$engine->expectObject('', ['id'], $response);
$engine->expectNatural('.id', $response->id);

$id = $response->id;

$response = $engine->request('bookmark/get');
$engine->expectStatus(400);
$engine->expectError('BOOKMARK_NOT_FOUND', $response);

$bookmark = $engine->request('bookmark/get', ['id' => $id]);
$engine->expectStatus(200);
expect_bookmark_object($engine, '', $bookmark);
$engine->expectValue('.url', $newBookmarkUrl, $bookmark->url);
$engine->expectValue('.title', $newBookmarkTitle, $bookmark->title);
$engine->expectValue('.tags', $newBookmarkTags, $bookmark->tags);
$engine->expectEquals('.insert_time', '.update_time', $bookmark->insert_time, $bookmark->update_time);

$response = $engine->request('bookmark/edit');
$engine->expectStatus(400);
$engine->expectError('BOOKMARK_NOT_FOUND', $response);

$response = $engine->request('bookmark/edit', ['id' => $id]);
$engine->expectStatus(400);
$engine->expectError('ENTER_URL', $response);

$response = $engine->request('bookmark/edit', [
    'id' => $id,
    'url' => $editedBookmarkUrl,
    'title' => $editedBookmarkTitle,
    'tags' => $manyTags,
]);
$engine->expectStatus(400);
$engine->expectError('TOO_MANY_TAGS', $response);

$response = $engine->request('bookmark/edit', [
    'id' => $id,
    'url' => $editedBookmarkUrl,
    'title' => $editedBookmarkTitle,
    'tags' => $editedBookmarkTags,
]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$bookmark = $engine->request('bookmark/get', ['id' => $id]);
expect_bookmark_object($engine, '', $bookmark);
$engine->expectValue('.url', $editedBookmarkUrl, $bookmark->url);
$engine->expectValue('.title', $editedBookmarkTitle, $bookmark->title);
$engine->expectValue('.tags', $editedBookmarkTags, $bookmark->tags);

$bookmarks = $engine->request('bookmark/list');
$engine->expectStatus(200);
$engine->expectType('', 'array', $bookmarks);
foreach ($bookmarks as $i => $bookmark) {
    expect_bookmark_object($engine, ".[$i]", $bookmark);
}

$response = $engine->request('bookmark/delete');
$engine->expectStatus(400);
$engine->expectError('BOOKMARK_NOT_FOUND', $response);

$response = $engine->request('bookmark/delete', ['id' => $id]);
$engine->expectStatus(200);
$engine->expectValue('', true, $response);

$response = $engine->request('bookmark/delete', ['id' => $id]);
$engine->expectStatus(400);
$engine->expectError('BOOKMARK_NOT_FOUND', $response);

echo "Done\n";
echo "$engine->numRequests requests made.\n";
