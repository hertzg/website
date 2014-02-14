<?php

namespace ContactTags;

function add ($mysqli, $idusers, $idcontacts, array $tagnames, $fullname) {
    $fullname = mysqli_real_escape_string($mysqli, $fullname);
    foreach ($tagnames as $tagname) {
        $tagname = mysqli_real_escape_string($mysqli, $tagname);
        mysqli_query(
            $mysqli,
            'insert into contacttags (idusers, idcontacts, tagname, fullname)'
            ." values ($idusers, $idcontacts, '$tagname', '$fullname')"
        );
    }
}
