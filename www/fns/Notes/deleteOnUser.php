<?php

namespace Notes;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from notes where id_users = $id_users");
}
