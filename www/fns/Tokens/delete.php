<?php

namespace Tokens;

function delete ($mysqli, $id) {
    $sql = "delete from tokens where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
