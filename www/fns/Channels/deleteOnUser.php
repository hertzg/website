<?php

namespace Channels;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from channels where id_users = $id_users");
}
