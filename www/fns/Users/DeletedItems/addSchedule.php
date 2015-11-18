<?php

namespace Users\DeletedItems;

function addSchedule ($mysqli, $schedule, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $schedule->id_users, 'schedule', [
        'id' => $schedule->id,
        'text' => $schedule->text,
        'interval' => $schedule->interval,
        'offset' => $schedule->offset,
        'tags' => $schedule->tags,
        'insert_api_key_id' => $schedule->insert_api_key_id,
        'insert_time' => $schedule->insert_time,
        'update_api_key_id' => $schedule->update_api_key_id,
        'update_time' => $schedule->update_time,
        'revision' => $schedule->revision,
    ], $apiKey);
}
