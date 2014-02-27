<?php

namespace Notes;

function indexOnUser ($mysqli, $idusers) {
    $sql = "select * from notes where idusers = $idusers"
        .' order by updatetime desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

