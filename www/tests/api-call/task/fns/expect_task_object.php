<?php

function expect_task_object ($engine, $variableName, $task) {
    $properties = ['id', 'text', 'deadline_time', 'tags',
        'top_priority', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $task);
    $engine->expectNatural("$variableName.id", $task->id);
    $engine->expectType("$variableName.text", 'string', $task->text);
    $engine->expectType("$variableName.tags", 'string', $task->tags);
    $engine->expectType("$variableName.top_priority",
        'boolean', $task->top_priority);
    $engine->expectNatural("$variableName.insert_time", $task->insert_time);
    $engine->expectNatural("$variableName.update_time", $task->update_time);
}
