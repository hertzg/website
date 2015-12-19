<?php

namespace ReceivedCalculations;

function delete ($mysqli, $id) {
    $sql = "delete from received_calculations where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
