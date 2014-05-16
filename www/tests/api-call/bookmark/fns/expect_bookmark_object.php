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
