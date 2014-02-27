<?php

namespace Bookmarks;

function indexOnUser ($mysqli, $idusers) {
    $sql = "select * from bookmarks where idusers = $idusers"
        .' order by updatetime desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
