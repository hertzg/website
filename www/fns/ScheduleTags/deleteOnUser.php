<?php

namespace ScheduleTags;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from schedule_tags where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
