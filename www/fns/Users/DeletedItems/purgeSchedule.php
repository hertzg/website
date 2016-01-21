<?php

namespace Users\DeletedItems;

function purgeSchedule ($mysqli, $deletedItem) {

    $data = json_decode($deletedItem->data_json);

    include_once __DIR__.'/../../ScheduleRevisions/deleteOnSchedule.php';
    \ScheduleRevisions\deleteOnSchedule($mysqli, $data->id);

}
