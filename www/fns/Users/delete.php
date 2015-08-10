<?php

namespace Users;

function delete ($mysqli, $id) {
    $sql = "delete from users where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
