<?php

namespace wallet;

function get_methods () {
    return [
        'add' => 'Creates a new wallet.',
        'delete' => 'Deletes an existing wallet.',
        'deleteAll' => 'Deletes all wallets.',
        'edit' => 'Edits an existing wallet.',
        'get' => 'Returns a single existing wallet.',
        'list' => 'Returns a list of all wallets.',
    ];
}
