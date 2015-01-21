<?php

namespace wallet\transaction;

function get_methods () {
    return [
        'add' => 'Creates a new transaction in a wallet.',
        'delete' => 'Deletes an existing transaction.',
        'deleteAll' => 'Deletes all transactions in a wallet.',
        'edit' => 'Edits an existing transaction.',
        'get' => 'Returns a single existing transaction.',
        'list' => 'Returns a list of all transactions in a wallet.',
    ];
}
