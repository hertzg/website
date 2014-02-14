<?php

namespace ContactTags;

function indexOnContact ($mysqli, $idcontacts) {
    $sql = 'select * from contacttags'
        ." where idcontacts = $idcontacts order by tagname";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
