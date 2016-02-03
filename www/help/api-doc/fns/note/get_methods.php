<?php

namespace note;

function get_methods () {
    return [
        'add' => 'Creates a new note.',
        'delete' => 'Deletes an existing note.',
        'deleteAll' => 'Deletes all notes.',
        'edit' => 'Edits an existing note.',
        'get' => 'Returns a single existing note.',
        'list' => 'Returns a list of all notes.',
        'send' => 'Sends a new note.',
        'sendExisting' => 'Sends an existing note.',
    ];
}
