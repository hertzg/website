<?php

namespace Contacts;

function editPhoto ($mysqli, $id, $photo_id) {
    $sql = "update contacts set photo_id = $photo_id where id_contacts = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
