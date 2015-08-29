<?php

namespace Users;

function editEncryptionKey ($mysqli,
    $id, $encryption_key, $encryption_key_iv) {

    $encryption_key = $mysqli->real_escape_string($encryption_key);
    $encryption_key_iv = $mysqli->real_escape_string($encryption_key_iv);

    $sql = "update users set encryption_key = '$encryption_key',"
        ." encryption_key_iv = '$encryption_key_iv' where id_users = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
