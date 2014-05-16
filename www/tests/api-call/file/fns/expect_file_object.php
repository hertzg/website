<?php

function expect_file_object ($engine, $variableName, $file) {
    $properties = ['id', 'name', 'size', 'insert_time', 'rename_time'];
    $engine->expectObject($variableName, $properties, $file);
    $engine->expectNatural("$variableName.id", $file->id);
    $engine->expectType("$variableName.name", 'string', $file->name);
    $engine->expectnatural("$variableName.size", $file->size);
    $engine->expectNatural("$variableName.insert_time", $file->insert_time);
    $engine->expectNatural("$variableName.rename_time", $file->rename_time);
}
