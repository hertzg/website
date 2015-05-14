<?php

namespace Signins;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from signins where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
