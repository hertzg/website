<?php

namespace Feedbacks;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from feedbacks where id_users = $id_users");
}
