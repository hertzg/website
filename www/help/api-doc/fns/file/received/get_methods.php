<?php

namespace file\received;

function get_methods () {
    return [
        'delete' => 'Deletes an existing received file.',
        'deleteAll' => 'Deletes all received files.',
        'download' => 'Returns the content of an existing file.',
        'get' => 'Returns a single existing received file.',
        'import' => 'Moves an existing received file in receiver\'s files.',
        'importCopy' => 'Copies an existing received file'
            .' in receiver\'s files.',
        'list' => 'Returns a list of all received files.',
    ];
}
