<?php

function to_client_json ($schedule) {
    return [
        'id' => (int)$schedule->id,
        'text' => $schedule->text,
        'interval' => (int)$schedule->interval,
        'offset' => (int)$schedule->offset,
        'insert_time' => (int)$schedule->insert_time,
        'update_time' => (int)$schedule->update_time,
    ];
}
