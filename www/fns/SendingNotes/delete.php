<?php

namespace SendingNotes;

function delete ($mysqli, $id) {
    $sql = "delete from sending_notes where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
