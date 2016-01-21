<?php

namespace ScheduleRevisions;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from schedule_revisions where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
