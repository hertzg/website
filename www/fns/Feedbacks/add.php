<?php

namespace Feedbacks;

function add ($mysqli, $idusers, $feedbacktext) {
    $feedbacktext = $mysqli->real_escape_string($feedbacktext);
    $insert_time = time();
    $sql = 'insert into feedbacks'
        .' (idusers, feedbacktext, insert_time)'
        ." values ($idusers, '$feedbacktext', $insert_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
