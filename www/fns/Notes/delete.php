<?php

namespace Notes;

function delete ($mysqli, $id) {
    $sql = "delete from notes where id_notes = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
