<?php

namespace Tasks;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from tasks where id_users = $id_users");
}
