<?php

namespace Bookmarks;

function get ($mysqli, $idusers, $id) {
    $sql = 'select * from bookmarks'
        ." where idusers = $idusers and idbookmarks = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
