<?php

function create_expires_label ($expire_time, &$dateAgoScript) {

    $label = 'Expires';
    $fnsDir = __DIR__.'/../../fns';

    if ($expire_time === null) {
        $content = 'Never';
    } elseif ($expire_time > time()) {
        include_once "$fnsDir/date_in.php";
        $content = ucfirst(date_in($expire_time));
    } else {
        $label = 'Expired';
        $dateAgoScript = true;
        include_once "$fnsDir/export_date_ago.php";
        $content = export_date_ago($expire_time, true);
    }

    include_once "$fnsDir/Form/label.php";
    return \Form\label($label, $content);

}
