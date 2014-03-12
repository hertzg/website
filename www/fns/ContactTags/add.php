<?php

namespace ContactTags;

function add ($mysqli, $idusers, $idcontacts, array $tagnames,
    $fullname, $alias) {

    $fullname = $mysqli->real_escape_string($fullname);
    $alias = $mysqli->real_escape_string($alias);

    foreach ($tagnames as $tagname) {
        $tagname = $mysqli->real_escape_string($tagname);
        $sql = 'insert into contacttags'
            .' (idusers, idcontacts,'
            .' tagname, fullname, alias)'
            ." values ($idusers, $idcontacts,"
            ." '$tagname', '$fullname', '$alias')";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

}
