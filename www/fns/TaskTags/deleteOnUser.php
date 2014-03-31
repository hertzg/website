<?php

namespace TaskTags;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from task_tags where id_users = $id_users");
}
