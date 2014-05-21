#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

include_once 'fns/receive.php';
receive();

$response = $engine->request('bookmark/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
include_once 'fns/expect_received_bookmark_object.php';
foreach ($response as $i => $receivedBookmark) {

    expect_received_bookmark_object($engine, "[$i]", $receivedBookmark);

    $id = $receivedBookmark->id;
    $url = $receivedBookmark->url;
    $title = $receivedBookmark->title;
    $tags = $receivedBookmark->tags;

    $response = $engine->request('bookmark/received/importCopy', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectNatural('', $response);

    $bookmark_id = $response;

    $response = $engine->request('bookmark/received/get', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    expect_received_bookmark_object($engine, '', $response);

    $response = $engine->request('bookmark/get', [
        'id' => $bookmark_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('.url', $url, $response->url);
    $engine->expectValue('.title', $title, $response->title);
    $engine->expectValue('.tags', $tags, $response->tags);

    $response = $engine->request('bookmark/received/import', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectNatural('', $response);

    $bookmark_id = $response;

    $response = $engine->request('bookmark/received/get', [
        'id' => $id,
    ]);
    $engine->expectError('RECEIVED_BOOKMARK_NOT_FOUND');

    $response = $engine->request('bookmark/get', [
        'id' => $bookmark_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('.url', $url, $response->url);
    $engine->expectValue('.title', $title, $response->title);
    $engine->expectValue('.tags', $tags, $response->tags);

    $response = $engine->request('bookmark/delete', [
        'id' => $bookmark_id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);

}

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
