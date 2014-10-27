<?php

namespace Contacts;

function deletePhoto ($mysqli, $id) {
    $sql = "update contacts set photo_id = null where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
