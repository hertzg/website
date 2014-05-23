<?php

namespace Bookmarks;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from bookmarks where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
