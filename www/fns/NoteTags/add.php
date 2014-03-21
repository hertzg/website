<?php

namespace NoteTags;

function add ($mysqli, $idusers, $idnotes, array $tagnames, $notetext) {
    $notetext = $mysqli->real_escape_string($notetext);
    $insert_time = $update_time = time();
    foreach ($tagnames as $tagname) {
        $tagname = $mysqli->real_escape_string($tagname);
        $sql = 'insert into note_tags (idusers, idnotes, tagname,'
            .' notetext, insert_time, update_time)'
            ." values ($idusers, $idnotes, '$tagname',"
            ." '$notetext', $insert_time, $update_time)";
        $mysqli->query($sql);
    }
}
