<?php

namespace NoteTags;

function indexOnTagName ($mysqli, $idusers, $tagname) {

    $tagname = $mysqli->real_escape_string($tagname);

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object(
        $mysqli,
        'select * from notetags'
        ." where idusers = $idusers"
        ." and tagname = '$tagname'"
        .' order by updatetime desc'
    );

}
