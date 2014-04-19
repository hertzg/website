<?php

namespace Channels;

function addNumUsers ($mysqli, $id, $num_users) {
    $sql = 'update channels set'
        ." num_users = num_users + $num_users where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli_error);
}
