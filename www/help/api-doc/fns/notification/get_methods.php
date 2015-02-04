<?php

namespace notification;

function get_methods () {
    return [
        'deleteAll' => 'Deletes all notifications.',
        'get' => 'Returns a single existing notification.',
        'list' => 'Returns a list of all notifications.',
        'post' => 'Sends a notification in a channel.',
    ];
}
