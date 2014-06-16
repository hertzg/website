<?php

namespace Files;

function delete ($mysqli, $id) {
    $sql = "delete from files where id_files = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
