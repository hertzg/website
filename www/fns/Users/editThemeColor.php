<?php

namespace Users;

function editThemeColor ($mysqli, $id_users, $color) {
    $color = $mysqli->real_escape_string($color);
    $sql = "update users set theme_color = '$color'"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
