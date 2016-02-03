<?php

namespace event;

function get_methods () {
    return [
        'add' => 'Creates a new event.',
        'delete' => 'Deletes an existing event.',
        'deleteAll' => 'Deletes all events.',
        'edit' => 'Edits an existing event.',
        'get' => 'Returns a single existing event.',
        'list' => 'Returns a list of all events.',
    ];
}
