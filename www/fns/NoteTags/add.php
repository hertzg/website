<?php

namespace NoteTags;

function add ($mysqli, $idusers, $idnotes, array $tagnames, $notetext) {
    $notetext = mysqli_real_escape_string($mysqli, $notetext);
    $inserttime = $updatetime = time();
    foreach ($tagnames as $tagname) {
        $tagname = mysqli_real_escape_string($mysqli, $tagname);
        mysqli_query(
            $mysqli,
            'insert into notetags (idusers, idnotes, tagname,'
            .' notetext, inserttime, updatetime)'
            ." values ($idusers, $idnotes, '$tagname',"
            ." '$notetext', $inserttime, $updatetime)"
        );
    }
}
