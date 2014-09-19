<?php

namespace ViewPage;

function createExpiresField ($apiKey) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/time_today.php";
    $time_today = time_today();

    $label = 'Expires';

    $expire_time = $apiKey->expire_time;
    if ($expire_time === null) {
        $content = 'Never';
    } else {
        $days = floor(($expire_time - $time_today) / (60 * 60 * 24));
        $date = date('M j, l', $expire_time);
        if ($expire_time >= $time_today) {
            if ($days == 0) $content = 'Today';
            elseif ($days == 1) $content = 'Tomorrow';
            else $content = "On $date ($days days left)";
        } else {
            $days = -$days;
            $label = 'Expired';
            if ($days == 1) $content = 'Yesterday';
            else $content = "On $date ($days days ago)";
        }
    }

    include_once "$fnsDir/Form/label.php";
    return \Form\label($label, $content);

}
