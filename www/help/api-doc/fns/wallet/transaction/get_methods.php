<?php

namespace wallet\transaction;

function get_methods () {
    return [
        'add' => 'Adds a new transaction to a wallet.',
        'delete' => 'Deletes an existing transaction.',
        'deleteAll' => 'Deletes all transactions of a wallet.',
        'edit' => 'Edits an existing transaction.',
        'get' => 'Returns a single existing transaction.',
        'list' => 'Returns a list of all transactions of a wallet.',
    ];
}
