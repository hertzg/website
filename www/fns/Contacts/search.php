<?php

namespace Contacts;

function search ($mysqli, $idusers, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = mysqli_real_escape_string($mysqli, $keyword);

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object(
        $mysqli,
        'select * from contacts'
        ." where idusers = $idusers and fullname like '%$keyword%'"
        .' order by fullname'
    );

}
