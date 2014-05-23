<?php

namespace Notes;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from notes where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
