<?php

namespace ScheduleRevisions;

function add ($mysqli, $id_schedules, $id_users, $text,
    $interval, $offset, $tags, $insert_time, $revision) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);

    $sql = 'insert into schedule_revisions'
        .' (id_schedules, id_users, text, `interval`,'
        .' offset, tags, insert_time, revision)'
        ." values ($id_schedules, $id_users, '$text', $interval,"
        ." $offset, '$tags', $insert_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
