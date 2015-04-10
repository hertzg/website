<?php

function create_expires_label ($expire_time) {

    $label = 'Expires';
    $fnsDir = __DIR__.'/../../fns';

    if ($expire_time === null) {
        $content = 'Never';
    } elseif ($expire_time > time()) {
        include_once "$fnsDir/date_in.php";
        $content = ucfirst(date_in($expire_time));
    } else {
        $label = 'Expired';
        include_once "$fnsDir/date_ago.php";
        $content = date_ago($expire_time, true);
    }

    include_once "$fnsDir/Form/label.php";
    return \Form\label($label, $content);

}
