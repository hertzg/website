<?php

function to_client_json ($schedule) {
    return [
        'id' => (int)$schedule->id,
        'text' => $schedule->text,
        'offset' => (int)$schedule->offset,
        'interval' => (int)$schedule->interval,
        'insert_time' => (int)$schedule->insert_time,
        'update_time' => (int)$schedule->update_time,
    ];
}
