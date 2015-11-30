<?php

namespace SendingCalculations;

function delete ($mysqli, $id) {
    $sql = "delete from sending_calculations where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
