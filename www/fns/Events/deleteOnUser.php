<?php

namespace Events;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from events where id_users = $id_users");
}
