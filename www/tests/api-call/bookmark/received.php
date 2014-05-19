#!/usr/bin/php
<?php

function expect_received_bookmark_object ($engine,
    $variableName, $receivedBookmark) {

    $properties = ['id', 'sender_username',
        'url', 'title', 'tags', 'insert_time'];
    $engine->expectObject($variableName, $properties, $receivedBookmark);
    $engine->expectNatural("$variableName.id", $receivedBookmark->id);
    $engine->expectType("$variableName.sender_username",
        'string', $receivedBookmark->sender_username);
    $engine->expectType("$variableName.url", 'string', $receivedBookmark->url);
    $engine->expectType("$variableName.title",
        'string', $receivedBookmark->title);
    $engine->expectType("$variableName.tags",
        'string', $receivedBookmark->tags);
    $engine->expectNatural("$variableName.insert_time",
        $receivedBookmark->insert_time);

}

function receive () {

    include_once '../fns/get_sender_engine.php';
    $engine = get_sender_engine();

    $engine->request('bookmark/send', [
        'url' => 'sample url',
        'title' => 'sample title',
        'tags' => 'tag1 tag2',
        'receiver_username' => 'aimnadze',
    ]);
    $engine->expectSuccess();

}

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

receive();

$ids = [];

$response = $engine->request('bookmark/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $receivedBookmark) {
    expect_received_bookmark_object($engine, "[$i]", $receivedBookmark);
    $ids[] = $receivedBookmark->id;
}

foreach ($ids as $id) {

    $response = $engine->request('bookmark/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_bookmark_object($engine, '', $response);

    $response = $engine->request('bookmark/received/delete', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

    $response = $engine->request('bookmark/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_BOOKMARK_NOT_FOUND');

}

receive();

$response = $engine->request('bookmark/received/deleteAll');
$engine->expectSuccess();
$engine->expectValue('', true, $response);

$response = $engine->request('bookmark/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
$engine->expectValue('.length', 0, count($response));

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
