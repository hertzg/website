<?php

include_once __DIR__.'/../lib/mysqli.php';
include_once 'fns/mysqli_sprintf.php';

class Feedbacks {

    static function add ($idusers, $feedbacktext) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'insert into feedbacks'
                .' (idusers, feedbacktext, inserttime)'
                ." values (#u, '#s', #u)",
                array($idusers, $feedbacktext, time())
            )
        );
    }

    static function deleteUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from feedbacks where idusers = $idusers");
    }

}
