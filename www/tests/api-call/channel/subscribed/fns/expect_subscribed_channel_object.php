<?php

function expect_subscribed_channel_object (
    $engine, $variableName, $subscribed_channel) {

    static $properties = ['id', 'channel_name',
        'receive_notifications', 'channel_public'];

    $engine->expectObject('', $properties, $subscribed_channel);
    $engine->expectType("$variableName.channel_name",
        'string', $subscribed_channel->channel_name);
    $engine->expectType("$variableName.channel_public",
        'boolean', $subscribed_channel->channel_public);
    $engine->expectNatural("$variableName.id", $subscribed_channel->id);
    $engine->expectType("$variableName.receive_notifications",
        'boolean', $subscribed_channel->receive_notifications);

}
