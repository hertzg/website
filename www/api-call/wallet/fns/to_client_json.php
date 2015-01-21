<?php

function to_client_json ($wallet) {
    return [
        'id' => (int)$wallet->id,
        'name' => $wallet->name,
        'insert_time' => (int)$wallet->insert_time,
        'update_time' => (int)$wallet->update_time,
    ];
}
