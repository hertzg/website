<?php

namespace Channels;

function setPublic ($mysqli, $id, $public) {
    $public = $public ? '1' : '0';
    $sql = "update channels set public = $public where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
