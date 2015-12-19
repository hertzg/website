<?php

namespace calculation;

function get_methods () {
    return [
        'add' => 'Creates a new calculation.',
        'delete' => 'Deletes an existing calculation.',
        'deleteAll' => 'Deletes all calculations.',
        'edit' => 'Edits an existing calculation.',
        'get' => 'Returns a single existing calculation.',
        'list' => 'Returns a list of all calculations.',
        'send' => 'Sends a new calculation.',
        'sendExisting' => 'Sends an existing calculation.',
    ];
}
