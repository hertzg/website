<?php

namespace BookmarkTags;

function indexOnTagName ($mysqli, $idusers, $tagname) {

    $tagname = mysqli_real_escape_string($mysqli, $tagname);

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object(
        $mysqli,
        'select * from bookmarktags'
        ." where idusers = $idusers"
        ." and tagname = '$tagname'"
        .' order by updatetime desc'
    );

}
