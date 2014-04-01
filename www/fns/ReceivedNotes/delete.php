<?php

namespace ReceivedNotes;

function delete ($mysqli, $id) {
    $sql = "delete from received_notes where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
