<?php

namespace TaskTags;

function searchOnTagName ($mysqli, $idusers, $keyword, $tagname) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = $mysqli->real_escape_string($keyword);
    $tagname = $mysqli->real_escape_string($tagname);

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object(
        $mysqli,
        'select * from tasktags'
        ." where idusers = $idusers"
        ." and tasktext like '%$keyword%'"
        ." and tagname = '$tagname'"
        .' order by top_priority desc, updatetime desc'
    );

}
