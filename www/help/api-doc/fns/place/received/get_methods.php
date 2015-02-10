<?php

namespace place\received;

function get_methods () {
    return [
        'delete' => 'Deletes an existing received place.',
        'deleteAll' => 'Deletes all received places.',
        'get' => 'Returns a single existing received place.',
        'import' => 'Moves an existing received place in receiver\'s places.',
        'importCopy' => 'Copies an existing received place'
            .' in receiver\'s places.',
        'list' => 'Returns a list of all received places.',
    ];
}
