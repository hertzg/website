<?php

function parse_expire_time ($user, &$expires, &$expire_time) {
    if ($expires !== 'never') {

        include_once __DIR__.'/../../fns/user_time_today.php';
        $time_today = user_time_today($user);

        $expires = (string)abs((int)$expires);
        $expire_time = $time_today + 60 * 60 * 24 * $expires;

    }
}
