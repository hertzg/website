<?php

namespace Notifications;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from notifications where id_users = $id_users");
}
