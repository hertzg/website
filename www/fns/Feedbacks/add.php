<?php

namespace Feedbacks;

function add ($mysqli, $idusers, $feedbacktext) {
    $feedbacktext = mysqli_real_escape_string($mysqli, $feedbacktext);
    $inserttime = time();
    mysqli_query(
        $mysqli,
        'insert into feedbacks'
        .' (idusers, feedbacktext, inserttime)'
        ." values ($idusers, '$feedbacktext', $inserttime)"
    );
    return mysqli_insert_id($mysqli);
}
