<?php

function expect_folder_object ($engine, $variableName, $folder) {
    $properties = ['id', 'name', 'insert_time', 'rename_time'];
    $engine->expectObject($variableName, $properties, $folder);
    $engine->expectNatural("$variableName.id", $folder->id);
    $engine->expectType("$variableName.name", 'string', $folder->name);
    $engine->expectNatural("$variableName.insert_time", $folder->insert_time);
    $engine->expectNatural("$variableName.rename_time", $folder->rename_time);
}
