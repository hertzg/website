<?php

namespace Tokens;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from tokens where id_users = $id_users");
}
