<?php

namespace InvalidSignins;

function deleteOlder ($mysqli, $insert_time) {
    $sql = "delete from invalid_signins where insert_time < $insert_time";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
