<?php

function create_expires_field ($apiKey) {
    $expire_time = $apiKey->expire_time;
    if ($expire_time === null) $content = 'never';
    else {
        $days = ceil(($expire_time - time()) / (60 * 60 * 24));
        if ($days == 0) $content = 'Today';
        elseif ($days == 1) $content = 'Tomorrow';
        else $content = 'on '.date('M j, l', $expire_time)." ($days days left)";
    }
    include_once __DIR__.'/../../../../fns/Form/label.php';
    return Form\label('Expires', $content);
}
