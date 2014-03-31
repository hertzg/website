<?php

namespace Users;

function editTheme ($mysqli, $id_users, $theme) {
    $theme = $mysqli->real_escape_string($theme);
    $sql = "update users set theme = '$theme' where id_users = $id_users";
    $mysqli->query($sql);
}
