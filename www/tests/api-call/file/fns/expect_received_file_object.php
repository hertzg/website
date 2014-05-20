<?php

function expect_received_file_object ($engine, $variableName, $receivedFile) {
    $properties = ['id', 'sender_username', 'name', 'size', 'insert_time'];
    $engine->expectObject($variableName, $properties, $receivedFile);
    $engine->expectNatural("$variableName.id", $receivedFile->id);
    $engine->expectType("$variableName.sender_username",
        'string', $receivedFile->sender_username);
    $engine->expectType("$variableName.name", 'string', $receivedFile->name);
    $engine->expectNatural("$variableName.size", $receivedFile->size);
    $engine->expectNatural("$variableName.insert_time", $receivedFile->insert_time);
}
