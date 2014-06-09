<?php

namespace channel\subscribed;

function get_methods () {
    return [
        'edit' => 'Edits an existing subscribed channel.',
        'get' => 'Returns a single existing subscribed channel.',
        'list' => 'Returns a list of all subscribed channels.',
        'subscribe' => 'Subscribes the user to a public channel.',
        'unsubscribe' => 'Unsubscribes the user from a public channel.',
    ];
}
