<?php

namespace Feedbacks;

function add ($mysqli, $idusers, $feedbacktext) {
    $feedbacktext = $mysqli->real_escape_string($feedbacktext);
    $inserttime = time();
    $sql = 'insert into feedbacks'
        .' (idusers, feedbacktext, inserttime)'
        ." values ($idusers, '$feedbacktext', $inserttime)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
