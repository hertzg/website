<?php

namespace Channels;

function delete ($mysqli, $id) {
    $sql = "delete from channels where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
