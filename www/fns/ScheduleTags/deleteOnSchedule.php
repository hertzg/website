<?php

namespace ScheduleTags;

function deleteOnSchedule ($mysqli, $id_schedules) {
    $sql = "delete from schedule_tags where id_schedules = $id_schedules";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
