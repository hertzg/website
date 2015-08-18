<?php

namespace Users;

function editThemeBrightness ($mysqli, $id_users, $brightness) {
    $brightness = $mysqli->real_escape_string($brightness);
    $sql = "update users set theme_brightness = '$brightness'"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
