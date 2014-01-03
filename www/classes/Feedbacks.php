<?php

include_once __DIR__.'/../lib/mysqli.php';

class Feedbacks {

    static function add ($idusers, $feedbacktext) {
        global $mysqli;
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

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from feedbacks where idusers = $idusers");
    }

}
