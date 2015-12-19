<?php

namespace ReceivedCalculations;

function setArchived ($mysqli, $id, $archived) {
    $archived = $archived ? '1' : '0';
    $sql = 'update received_calculations'
        ." set archived = $archived where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
