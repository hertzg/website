<?php

namespace NoteTags;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from note_tags where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
