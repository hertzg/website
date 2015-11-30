<?php

namespace calculation\received;

function get_methods () {
    return [
        'delete' => 'Deletes an existing received calculation.',
        'deleteAll' => 'Deletes all received calculations.',
        'get' => 'Returns a single existing received calculation.',
        'import' => 'Moves an existing received calculation'
            .' in receiver\'s calculations.',
        'importCopy' => 'Copies an existing received calculation'
            .' in receiver\'s calculations.',
        'list' => 'Returns a list of all received calculations.',
    ];
}
