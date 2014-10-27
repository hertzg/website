<?php

namespace Contacts;

function delete ($mysqli, $id) {
    $sql = "delete from contacts where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
