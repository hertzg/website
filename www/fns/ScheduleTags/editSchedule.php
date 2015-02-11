<?php

namespace ScheduleTags;

function editSchedule ($mysqli, $id_schedules, $text,
    $interval, $offset, $insert_time, $update_time) {

    $text = $mysqli->real_escape_string($text);

    $sql = "update schedule_tags set text = '$text',"
        ." `interval` = $interval, offset = $offset,"
        ." insert_time = $insert_time, update_time = $update_time"
        ." where id_schedules = $id_schedules";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
