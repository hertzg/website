<?php

function expect_file_object ($engine, $variableName, $file) {
    $properties = ['id', 'name', 'size', 'md5_sum',
        'sha256_sum', 'insert_time', 'rename_time'];
    $engine->expectObject($variableName, $properties, $file);
    $engine->expectNatural("$variableName.id", $file->id);
    $engine->expectType("$variableName.name", 'string', $file->name);
    $engine->expectnatural("$variableName.size", $file->size);
    $engine->expectType("$variableName.md5_sum", 'string', $file->md5_sum);
    $engine->expectType("$variableName.sha256_sum",
        'string', $file->sha256_sum);
    $engine->expectNatural("$variableName.insert_time", $file->insert_time);
    $engine->expectNatural("$variableName.rename_time", $file->rename_time);
}
