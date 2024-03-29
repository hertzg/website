<?php

function create_expires_label ($expire_time) {

    $label = 'Expires';

    if ($expire_time === null) {
        $content = 'Never';
    } elseif ($expire_time > time()) {
        include_once __DIR__.'/date_in.php';
        $content = ucfirst(date_in($expire_time));
    } else {
        $label = 'Expired';
        include_once __DIR__.'/export_date_ago.php';
        $content = export_date_ago($expire_time, true);
    }

    include_once __DIR__.'/Form/label.php';
    return \Form\label($label, $content);

}
