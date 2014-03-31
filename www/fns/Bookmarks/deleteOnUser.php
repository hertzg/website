<?php

namespace Bookmarks;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from bookmarks where id_users = $id_users");
}
