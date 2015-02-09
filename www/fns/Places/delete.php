<?php

namespace Places;

function delete ($mysqli, $id) {
    $sql = "delete from places where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
