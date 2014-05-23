<?php

namespace Feedbacks;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from feedbacks where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
