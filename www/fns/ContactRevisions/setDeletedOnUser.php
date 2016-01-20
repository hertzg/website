<?php

namespace ContactRevisions;

function setDeletedOnUser ($mysqli, $id_users) {
    $sql = 'update contact_revisions set'
        ." deleted = 1 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
