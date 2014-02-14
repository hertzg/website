<?php

namespace Users;

function editTheme ($mysqli, $idusers, $theme) {
    $theme = mysqli_real_escape_string($mysqli, $theme);
    $sql = "update users set theme = '$theme' where idusers = $idusers";
    mysqli_query($mysqli, $sql);
}
