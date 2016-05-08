<?php

namespace ContactTags;

function deleteContactPhoto ($mysqli, $id_contacts) {
    $sql = 'update contact_tags set photo_id = null'
        ." where id_contacts = $id_contacts";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
