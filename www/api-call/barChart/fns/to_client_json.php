<?php

function to_client_json ($bar_chart) {
    return [
        'id' => (int)$bar_chart->id,
        'name' => $bar_chart->name,
        'insert_time' => (int)$bar_chart->insert_time,
        'update_time' => (int)$bar_chart->update_time,
    ];
}
