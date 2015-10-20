<?php

namespace ApiKeyAuths;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from api_key_auths where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
