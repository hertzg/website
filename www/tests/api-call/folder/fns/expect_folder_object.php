<?php

function expect_folder_object ($engine, $variableName, $folder) {
    $engine->expectObject($variableName, ['id', 'name', 'insert_time'], $folder);
    $engine->expectNatural("$variableName.id", $folder->id);
    $engine->expectType("$variableName.name", 'string', $folder->name);
    $engine->expectNatural("$variableName.insert_time", $folder->insert_time);
}
