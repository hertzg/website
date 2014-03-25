<?php

namespace Connections;

function delete ($mysqli, $id) {
    $sql = "delete from connections where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
