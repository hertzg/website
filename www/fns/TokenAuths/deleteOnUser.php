<?php

namespace TokenAuths;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from token_auths where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
