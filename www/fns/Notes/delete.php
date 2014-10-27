<?php

namespace Notes;

function delete ($mysqli, $id) {
    $sql = "delete from notes where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
