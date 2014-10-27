<?php

namespace ScheduleTags;

function add ($mysqli, $id_users, $id_schedules,
    $tag_names, $text, $interval, $offset) {

    $text = $mysqli->real_escape_string($text);
    $insert_time = $update_time = time();

    $sql = 'insert into schedule_tags (id_users, id_schedules, tag_name,'
        .' text, `interval`, offset, insert_time, update_time) values ';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_schedules, '$tag_name',"
            ." '$text', $interval, $offset, $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
