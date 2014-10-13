<?php

namespace folder\received;

function get_methods () {
    return [
        'delete' => 'Deletes an existing received folder.',
        'deleteAll' => 'Deletes all received folders.',
        'get' => 'Returns a single existing received folder.',
        'import' => 'Moves an existing received folder in receiver\'s files.',
        'importCopy' => 'Copies an existing received folder'
            .' in receiver\'s files.',
        'list' => 'Returns a list of all received folders.',
    ];
}
