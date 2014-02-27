<?php

namespace Users;

function editTheme ($mysqli, $idusers, $theme) {
    $theme = $mysqli->real_escape_string($theme);
    $sql = "update users set theme = '$theme' where idusers = $idusers";
    $mysqli->query($sql);
}
