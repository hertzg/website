<?php

namespace Bookmarks;

function delete ($mysqli, $id) {
    $sql = "delete from bookmarks where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
