<?php

function expect_file_object ($engine, $variableName, $file) {
    $engine->expectObject($variableName, ['id', 'name', 'size', 'insert_time'], $file);
    $engine->expectNatural("$variableName.id", $file->id);
    $engine->expectType("$variableName.name", 'string', $file->name);
    $engine->expectnatural("$variableName.size", $file->size);
    $engine->expectNatural("$variableName.insert_time", $file->insert_time);
}
