<?php

namespace Places;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from places where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
