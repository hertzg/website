<?php

namespace Channels;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from channels where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
