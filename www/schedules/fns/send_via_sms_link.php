<?php

function send_via_sms_link ($user, $schedule) {

    $fnsDir = __DIR__.'/../../fns';
    $interval = $schedule->interval;

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($user, $interval, $schedule->offset);

    include_once "$fnsDir/user_time_today.php";
    $next_time = user_time_today($user) + $days_left * 60 * 60 * 24;

    $text = "$schedule->text\nRepeats in every $interval days\n"
        ."Next on ".date('l, F j, Y', $next_time);

    include_once "$fnsDir/Page/imageLink.php";
    return Page\imageLink('Send via SMS',
        'sms:?body='.rawurlencode($text), 'send-sms');

}
