<?php

namespace TokenAuths;

function deleteOlder ($mysqli, $insert_time) {
    $sql = "delete from token_auths where insert_time < $insert_time";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
