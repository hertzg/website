<?php

namespace ReceivedFolders;

function setArchived ($mysqli, $id, $archived) {
    $archived = $archived ? '1' : '0';
    $sql = "update received_folders set archived = $archived where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
