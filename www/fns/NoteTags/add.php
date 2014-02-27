<?php

namespace NoteTags;

function add ($mysqli, $idusers, $idnotes, array $tagnames, $notetext) {
    $notetext = $mysqli->real_escape_string($notetext);
    $inserttime = $updatetime = time();
    foreach ($tagnames as $tagname) {
        $tagname = $mysqli->real_escape_string($tagname);
        $sql = 'insert into notetags (idusers, idnotes, tagname,'
            .' notetext, inserttime, updatetime)'
            ." values ($idusers, $idnotes, '$tagname',"
            ." '$notetext', $inserttime, $updatetime)";
        $mysqli->query($sql);
    }
}
