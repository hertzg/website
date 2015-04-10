<?php

function export_date_ago ($time) {
    include_once __DIR__.'/date_ago.php';
    return
        "<span class=\"dateAgo\" data-time=\"$time\">"
            .date_ago($time)
        .'</span>';
}
