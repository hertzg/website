<?php

namespace Tasks;

function edit ($mysqli, $id_users, $id, $text, $tags) {
    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $update_time = time();
    $sql = "update tasks set text = '$text',"
        ." tags = '$tags', update_time = $update_time"
        ." where id_users = $id_users and id_tasks = $id";
    $mysqli->query($sql);
}
