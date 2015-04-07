<?php

function request_new_event_values ($key, $user) {
    if (array_key_exists($key, $_SESSION)) {
        $values = $_SESSION[$key];
    } else {

        $fnsDir = __DIR__.'/../../fns';

        include_once "$fnsDir/Events/request.php";
        list($event_time, $text, $raw_event_time) = Events\request();

        if ($raw_event_time === '') {
            include_once "$fnsDir/user_time_today.php";
            $event_time = user_time_today($user);
        }

        $year = (int)date('Y', $event_time);
        $month = (int)date('n', $event_time);
        $day = (int)date('j', $event_time);

        $values = [
            'event_day' => $day,
            'event_month' => $month,
            'event_year' => $year,
            'text' => $text,
        ];

    }
    return $values;
}
