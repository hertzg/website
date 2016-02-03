<?php

namespace user;

function get_methods () {
    return [
        'add' => 'Creates a new user.',
        'delete' => 'Deletes an existing user.',
        'editProfile' => 'Edits the profile of an existing user.',
        'get' => 'Returns a single existing user.',
        'list' => 'Returns a list of all users.',
        'resetPassword' => 'Resets the password of an existing user.',
    ];
}
