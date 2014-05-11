#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';

$url = 'sample url';
$title = 'sample title';
$tags = 'tag1 tag2';
$receiver_username = 'aimnadze';

$engine = new Engine;
$engine->api_key = '6dd831e2f696691091a36b5b4d400e6af6a4fe4c68d3ab2727432338a258144d';
$engine->request('bookmark/send', [
    'url' => $url,
    'title' => $title,
    'tags' => $tags,
    'receiver_username' => $receiver_username,
]);
$engine->expectSuccess();

$engine = new Engine;

$ids = [];

$response = $engine->request('bookmark/received/list');
$engine->expectSuccess();
$engine->expectType('', 'array', $response);
foreach ($response as $i => $receivedBookmark) {
    $properties = ['id', 'sender_username', 'url', 'title', 'tags', 'insert_time'];
    $engine->expectObject("[$i]", $properties, $receivedBookmark);
    $engine->expectNatural("[$i].id", $receivedBookmark->id);
    $engine->expectType("[$i].sender_username", 'string', $receivedBookmark->sender_username);
    $engine->expectType("[$i].url", 'string', $receivedBookmark->url);
    $engine->expectType("[$i].title", 'string', $receivedBookmark->title);
    $engine->expectType("[$i].tags", 'string', $receivedBookmark->tags);
    $engine->expectNatural("[$i].insert_time", $receivedBookmark->insert_time);
    $ids[] = $receivedBookmark->id;
}

foreach ($ids as $id) {
    $response = $engine->request('bookmark/received/delete', [
        'id' => $id,
    ]);
    $engine->expectSuccess();
    $engine->expectValue('', true, $response);
}

echo "Done\n";
echo "$engine->numRequests requests made.\n";
