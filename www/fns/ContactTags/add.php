<?php

namespace ContactTags;

function add ($mysqli, $idusers, $idcontacts, array $tagnames,
    $full_name, $alias) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);

    foreach ($tagnames as $tagname) {
        $tagname = $mysqli->real_escape_string($tagname);
        $sql = 'insert into contacttags'
            .' (idusers, idcontacts,'
            .' tagname, full_name, alias)'
            ." values ($idusers, $idcontacts,"
            ." '$tagname', '$full_name', '$alias')";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

}
