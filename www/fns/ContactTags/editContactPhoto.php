<?php

namespace ContactTags;

function editContactPhoto ($mysqli, $id_contacts, $photo_id) {
    $sql = "update contact_tags set photo_id = $photo_id"
        ." where id_contacts = $id_contacts";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
