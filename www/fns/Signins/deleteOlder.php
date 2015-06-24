<?php

namespace Signins;

function deleteOlder ($mysqli, $insert_time) {
    $sql = "delete from signins where insert_time < $insert_time";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
