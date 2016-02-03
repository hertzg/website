<?php

namespace place;

function get_methods () {
    return [
        'add' => 'Creates a new place.',
        'delete' => 'Deletes an existing place.',
        'deleteAll' => 'Deletes all places.',
        'edit' => 'Edits an existing place.',
        'get' => 'Returns a single existing place.',
        'list' => 'Returns a list of all places.',
        'send' => 'Sends a new place.',
        'sendExisting' => 'Sends an existing place.',
    ];
}
