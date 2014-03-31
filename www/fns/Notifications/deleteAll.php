<?php

namespace Notifications;

function deleteAll ($mysqli, $id_users) {
    $mysqli->query("delete from notifications where id_users = $id_users");
}
