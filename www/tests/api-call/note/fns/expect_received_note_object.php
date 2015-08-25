<?php

function expect_received_note_object ($engine, $variableName, $receivedNote) {
    $properties = ['id', 'sender_username', 'text',
        'tags', 'encrypt_in_listings', 'insert_time'];
    $engine->expectObject($variableName, $properties, $receivedNote);
    $engine->expectNatural("$variableName.id", $receivedNote->id);
    $engine->expectType("$variableName.sender_username",
        'string', $receivedNote->sender_username);
    $engine->expectType("$variableName.text", 'string', $receivedNote->text);
    $engine->expectType("$variableName.tags", 'string', $receivedNote->tags);
    $engine->expectType("$variableName.encrypt_in_listings",
        'boolean', $receivedNote->encrypt_in_listings);
    $engine->expectNatural("$variableName.insert_time",
        $receivedNote->insert_time);
}
