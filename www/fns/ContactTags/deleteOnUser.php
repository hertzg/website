<?php

namespace ContactTags;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from contact_tags where id_users = $id_users");
}
