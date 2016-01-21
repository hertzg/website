<?php

namespace ScheduleRevisions;

function setDeletedOnSchedule ($mysqli, $id_schedules, $deleted) {
    $deleted = $deleted ? '1' : '0';
    $sql = "update schedule_revisions set deleted = $deleted"
        ." where id_schedules = $id_schedules";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
