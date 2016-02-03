<?php

namespace schedule;

function get_methods () {
    return [
        'add' => 'Creates a new schedule.',
        'delete' => 'Deletes an existing schedule.',
        'deleteAll' => 'Deletes all schedules.',
        'edit' => 'Edits an existing schedule.',
        'get' => 'Returns a single existing schedule.',
        'list' => 'Returns a list of all schedules.',
        'send' => 'Sends a new schedule.',
        'sendExisting' => 'Sends an existing schedule.',
    ];
}
