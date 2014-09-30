<?php

namespace InvalidSignins;

function add ($mysqli, $remote_address) {

    $insert_time = time();
    $remote_address = $mysqli->real_escape_string($remote_address);

    $sql = 'insert into invalid_signins (remote_address, insert_time)'
        ." values ('$remote_address', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
