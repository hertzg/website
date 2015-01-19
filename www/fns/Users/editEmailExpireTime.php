<?php

namespace Users;

function editEmailExpireTime ($mysqli, $id, $email_expire_time) {
    $sql = "update users set email_expire_time = $email_expire_time"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
