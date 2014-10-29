<?php

namespace InvalidSignins;

function add ($mysqli, $username, $remote_address) {

    $username = $mysqli->real_escape_string($username);
    $remote_address = $mysqli->real_escape_string($remote_address);
    $insert_time = time();

    $sql = 'insert into invalid_signins'
        .' (username, remote_address, insert_time)'
        ." values ('$username', '$remote_address', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
