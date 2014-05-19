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
