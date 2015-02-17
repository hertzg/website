<?php

namespace channel\user;

function get_methods () {
    return [
        'add' => 'Adds a new user to a channel.',
        'list' => 'Returns the list of all the users of a channel.',
        'remove' => 'Removes an added user from a channel.',
    ];
}
