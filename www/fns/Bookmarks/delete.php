<?php

namespace Bookmarks;

function delete ($mysqli, $id) {
    $sql = "delete from bookmarks where id_bookmarks = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
