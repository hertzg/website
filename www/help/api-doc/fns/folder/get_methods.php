<?php

namespace folder;

function get_methods () {
    return [
        'add' => 'Creates a new folder.',
        'delete' => 'Deletes an existing folder and its contents.',
        'get' => 'Returns a single existing folder.',
        'list' => 'Returns a list of folders.',
        'rename' => 'Renames an existing folder.',
        'sendExisting' => 'Sends an existing folder.',
    ];
}
