<?php

namespace NoteTags;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from note_tags where id_users = $id_users");
}
