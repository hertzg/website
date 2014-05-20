<?php

function expect_received_task_object ($engine, $variableName, $receivedTask) {
    $properties = ['id', 'sender_username', 'text',
        'top_priority', 'tags', 'insert_time'];
    $engine->expectObject($variableName, $properties, $receivedTask);
    $engine->expectNatural("$variableName.id", $receivedTask->id);
    $engine->expectType("$variableName.sender_username",
        'string', $receivedTask->sender_username);
    $engine->expectType("$variableName.text", 'string', $receivedTask->text);
    $engine->expectType("$variableName.top_priority",
        'boolean', $receivedTask->top_priority);
    $engine->expectType("$variableName.tags", 'string', $receivedTask->tags);
    $engine->expectNatural("$variableName.insert_time",
        $receivedTask->insert_time);
}
