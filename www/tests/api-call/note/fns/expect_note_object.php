<?php

function expect_note_object ($engine, $variableName, $note) {
    $properties = ['id', 'text', 'tags', 'encrypt_in_listings',
        'password_protect', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $note);
    $engine->expectNatural("$variableName.id", $note->id);
    $engine->expectType("$variableName.text", 'string', $note->text);
    $engine->expectType("$variableName.tags", 'string', $note->tags);
    $engine->expectType("$variableName.encrypt_in_listings",
        'boolean', $note->encrypt_in_listings);
    $engine->expectType("$variableName.password_protect",
        'boolean', $note->password_protect);
    $engine->expectNatural("$variableName.insert_time", $note->insert_time);
    $engine->expectNatural("$variableName.update_time", $note->update_time);
}
