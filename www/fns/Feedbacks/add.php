<?php

namespace Feedbacks;

function add ($mysqli, $id_users, $feedbacktext) {
    $feedbacktext = $mysqli->real_escape_string($feedbacktext);
    $insert_time = time();
    $sql = 'insert into feedbacks'
        .' (id_users, feedbacktext, insert_time)'
        ." values ($id_users, '$feedbacktext', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;
}
