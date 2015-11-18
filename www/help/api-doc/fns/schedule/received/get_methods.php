<?php

namespace schedule\received;

function get_methods () {
    return [
        'delete' => 'Deletes an existing received schedule.',
        'deleteAll' => 'Deletes all received schedules.',
        'get' => 'Returns a single existing received schedule.',
        'import' => 'Moves an existing received schedule'
            .' in receiver\'s schedules.',
        'importCopy' => 'Copies an existing received schedule'
            .' in receiver\'s schedules.',
        'list' => 'Returns a list of all received schedules.',
    ];
}
