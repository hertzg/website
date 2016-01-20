<?php

namespace ContactRevisions;

function setDeletedOnContact ($mysqli, $id_contacts, $deleted) {
    $deleted = $deleted ? '1' : '0';
    $sql = "update contact_revisions set deleted = $deleted"
        ." where id_contacts = $id_contacts";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
