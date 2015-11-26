<?php

namespace SendingNotes;

function increaseNumFails ($mysqli, $id) {
    $sql = 'update sending_notes set'
        ." num_fails = num_fails + 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
