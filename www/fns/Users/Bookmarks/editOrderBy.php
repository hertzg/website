<?php

namespace Users\Bookmarks;

function editOrderBy ($mysqli, $id, $bookmarks_order_by) {
    $sql = "update users set bookmarks_order_by = '$bookmarks_order_by'"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
