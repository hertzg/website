<?php

namespace Bookmarks;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from bookmarks where id_bookmarks = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    $bookmark = mysqli_single_object($mysqli, $sql);
    if ($bookmark && $bookmark->id_users == $id_users) return $bookmark;
}
