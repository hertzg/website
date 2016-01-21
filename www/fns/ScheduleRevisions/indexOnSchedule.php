<?php

namespace ScheduleRevisions;

function indexOnSchedule ($mysqli, $id_schedules) {
    $sql = 'select * from schedule_revisions'
        ." where id_schedules = $id_schedules order by insert_time desc";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
