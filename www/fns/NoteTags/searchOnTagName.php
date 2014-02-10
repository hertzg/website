<?php

namespace NoteTags;

function searchOnTagName ($mysqli, $idusers, $keyword, $tagname) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = mysqli_real_escape_string($mysqli, $keyword);
    $tagname = mysqli_real_escape_string($mysqli, $tagname);

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object(
        $mysqli,
        'select * from notetags'
        ." where idusers = $idusers"
        ." and notetext like '%$keyword%'"
        ." and tagname = '$tagname'"
        .' order by updatetime desc'
    );

}
