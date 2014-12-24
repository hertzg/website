<?php

namespace Files;

function increaseContentRevision ($mysqli, $id) {
    $sql = 'update files set content_revision = content_revision + 1'
        ." where id_files = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
