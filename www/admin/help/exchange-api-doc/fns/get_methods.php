<?php

function get_methods () {
    return [
        'doNothing' => 'Does nothing. Used for authentication testing.',
        'receiveBookmark' => 'Handle a bookmark sent to a user.',
        'receiveContact' => 'Handle a contact sent to a user.',
        'receiveNote' => 'Handle a note sent to a user.',
        'receivePlace' => 'Handle a place sent to a user.',
        'receiveTask' => 'Handle a task sent to a user.',
    ];
}
