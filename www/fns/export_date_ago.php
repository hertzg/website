<?php

function export_date_ago ($time, $uppercase = false) {

    if ($uppercase) $uppercaseAttribute = ' data-uppercase="1"';
    else $uppercaseAttribute = '';

    include_once __DIR__.'/date_ago.php';
    return
        "<span class=\"dateAgo\" data-time=\"$time\"$uppercaseAttribute>"
            .date_ago($time, $uppercase)
        .'</span>';

}
