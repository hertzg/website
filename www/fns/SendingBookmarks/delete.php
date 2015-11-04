<?php

namespace SendingBookmarks;

function delete ($mysqli, $id) {
    $sql = "delete from sending_bookmarks where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
