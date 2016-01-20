<?php

namespace ContactRevisions;

function deleteOnContact ($mysqli, $id_contacts) {
    $sql = "delete from contact_revisions where id_contacts = $id_contacts";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
