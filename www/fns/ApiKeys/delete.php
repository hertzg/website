<?php

namespace ApiKeys;

function delete ($mysqli, $id) {
    $sql = "delete fro api_keys where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
