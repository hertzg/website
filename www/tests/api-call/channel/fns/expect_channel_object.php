<?php

function expect_channel_object ($engine, $variableName, $channel) {
    $properties = ['id', 'channel_name', 'public',
        'receive_notifications', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $channel);
    $engine->expectNatural("$variableName.id", $channel->id);
    $engine->expectType("$variableName.channel_name",
        'string', $channel->channel_name);
    $engine->expectType("$variableName.public", 'boolean', $channel->public);
    $engine->expectType("$variableName.receive_notifications",
        'boolean', $channel->receive_notifications);
    $engine->expectNatural("$variableName.insert_time", $channel->insert_time);
    $engine->expectNatural("$variableName.update_time", $channel->update_time);
}
