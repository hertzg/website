<?php

namespace Folders;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from folders where id_users = $id_users");
}
