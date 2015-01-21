<?php

function to_client_json ($transaction) {
    return [
        'id' => (int)$transaction->id,
        'amount' => $transaction->amount,
        'description' => $transaction->description,
        'insert_time' => (int)$transaction->insert_time,
        'update_time' => (int)$transaction->update_time,
    ];
}
