<?php

namespace TaskTags;

function indexOnUser ($mysqli, $idusers) {
    $sql = 'select distinct tagname from tasktags'
        ." where idusers = $idusers order by tagname";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
