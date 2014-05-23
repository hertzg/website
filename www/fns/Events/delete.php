<?php

namespace Events;

function delete ($mysqli, $id) {
    $sql = "delete from events where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
