<?php

namespace Users\DeletedItems;

function addBarChart ($mysqli, $bar_chart, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $bar_chart->id_users, 'barChart', [
        'id' => $bar_chart->id,
        'name' => $bar_chart->name,
        'insert_api_key_id' => $bar_chart->insert_api_key_id,
        'insert_time' => $bar_chart->insert_time,
        'update_api_key_id' => $bar_chart->update_api_key_id,
        'update_time' => $bar_chart->update_time,
        'revision' => $bar_chart->revision,
    ], $apiKey);
}
