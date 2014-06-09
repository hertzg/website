<?php

namespace task\received;

function get_methods () {
    return [
        'delete' => 'Deletes an existing received task.',
        'deleteAll' => 'Deletes all received tasks.',
        'get' => 'Returns a single existing received task.',
        'import' => 'Moves an existing received task in receiver\'s tasks.',
        'importCopy' => 'Copies an existing received task'
            .' in receiver\'s tasks.',
        'list' => 'Returns a list of all received tasks.',
    ];
}
