<?php

namespace Tokens;

function updateAccessTime ($mysqli, $id) {
    $access_time = time();
    $sql = "update tokens set access_time = $access_time where id = $id";
    $mysqli->query($sql);
}
