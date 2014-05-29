<?php

function expect_note_object ($engine, $variableName, $note) {
    $properties = ['id', 'text', 'tags',
        'encrypt', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $note);
    $engine->expectNatural("$variableName.id", $note->id);
    $engine->expectType("$variableName.text", 'string', $note->text);
    $engine->expectType("$variableName.tags", 'string', $note->tags);
    $engine->expectType("$variableName.encrypt", 'boolean', $note->encrypt);
    $engine->expectNatural("$variableName.insert_time", $note->insert_time);
    $engine->expectNatural("$variableName.update_time", $note->update_time);
}
