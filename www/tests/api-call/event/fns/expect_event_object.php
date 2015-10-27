<?php

function expect_event_object ($engine, $variableName, $event) {
    $properties = ['id', 'text', 'event_time', 'start_hour',
        'start_minute', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $event);
    $engine->expectNatural("$variableName.id", $event->id);
    $engine->expectType("$variableName.text", 'string', $event->text);
    $engine->expectType("$variableName.event_time",
        'integer', $event->event_time);
    $engine->expectType("$variableName.start_hour",
        'integer', $event->start_hour);
    $engine->expectType("$variableName.start_hour",
        'integer', $event->start_hour);
    $engine->expectNatural("$variableName.insert_time", $event->insert_time);
    $engine->expectNatural("$variableName.update_time", $event->update_time);
}
