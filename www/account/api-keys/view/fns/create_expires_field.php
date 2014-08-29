<?php

function create_expires_field ($apiKey) {

    include_once __DIR__.'/../../../../fns/time_today.php';
    $time_today = time_today();

    $label = 'Expires';

    $expire_time = $apiKey->expire_time;
    if ($expire_time === null) {
        $content = 'never';
    } else {
        $days = floor(($expire_time - $time_today) / (60 * 60 * 24));
        if ($expire_time >= $time_today) {
            if ($days == 0) $content = 'today';
            elseif ($days == 1) $content = 'tomorrow';
            else $content = 'on '.date('M j, l', $expire_time)." ($days days left)";
        } else {
            $days = -$days;
            $label = 'Expired';
            if ($days == 1) $content = 'yesterday';
            else $content = 'on '.date('M j, l', $expire_time)." ($days days ago)";
        }
    }

    include_once __DIR__.'/../../../../fns/Form/label.php';
    return Form\label($label, $content);

}
