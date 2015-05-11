<?php

function to_client_json ($bar) {
    return [
        'id' => (int)$bar->id,
        'value' => $bar->value,
        'label' => $bar->label,
        'insert_time' => (int)$bar->insert_time,
        'update_time' => (int)$bar->update_time,
    ];
}
