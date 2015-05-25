<?php

namespace Notifications;

function delete ($mysqli, $id) {
    $sql = "delete from notifications where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
