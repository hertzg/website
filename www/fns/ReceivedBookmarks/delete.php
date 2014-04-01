<?php

namespace ReceivedBookmarks;

function delete ($mysqli, $id) {
    $sql = "delete from received_bookmarks where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
