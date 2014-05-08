<?php

namespace Users\Email;

function verify ($mysqli, $id_users) {
    $sql = 'update users set verify_email_key = null, email_verified = 1,'
        ." verify_email_key_time = null where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
