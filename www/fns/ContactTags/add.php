<?php

namespace ContactTags;

function add ($mysqli, $idusers, $idcontacts, array $tagnames, $fullname) {
    $fullname = $mysqli->real_escape_string($fullname);
    foreach ($tagnames as $tagname) {
        $tagname = $mysqli->real_escape_string($tagname);
        $sql = 'insert into contacttags'
            .' (idusers, idcontacts, tagname, fullname)'
            ." values ($idusers, $idcontacts, '$tagname', '$fullname')";
        $mysqli->query($sql);
    }
}
