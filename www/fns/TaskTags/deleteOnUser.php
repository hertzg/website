<?php

namespace TaskTags;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from task_tags where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
