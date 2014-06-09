<?php

namespace file;

function get_methods () {
    return [
        'add' => 'Creates a new file.',
        'delete' => 'Deletes an existing file.',
        'download' => 'Returns the content of an existing file.',
        'get' => 'Returns a single existing file.',
        'list' => 'Returns a list of files.',
        'rename' => 'Renames an existing file.',
        'send' => 'Sends a new file.',
        'sendExisting' => 'Sends an existing file.',
    ];
}
