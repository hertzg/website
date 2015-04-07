<?php

function request_new_event_values ($key) {
    if (array_key_exists($key, $_SESSION)) {
        $values = $_SESSION[$key];
    } else {

        $fnsDir = __DIR__.'/../../fns';

        include_once "$fnsDir/Events/request.php";
        list($event_time, $text, $raw_event_time) = Events\request();

        if ($raw_event_time === '') {

            include_once "$fnsDir/request_strings.php";
            list($year, $month, $day) = request_strings('year', 'month', 'day');

            $day = abs((int)$day);
            $month = abs((int)$month);
            $year = abs((int)$year);

            if ($year === 0) $year = (int)date('Y');
            if ($month === 0) $month = (int)date('n');
            if ($day === 0) $day = (int)date('j');

        } else {
            $year = (int)date('Y', $event_time);
            $month = (int)date('n', $event_time);
            $day = (int)date('j', $event_time);
        }

        $values = [
            'event_day' => $day,
            'event_month' => $month,
            'event_year' => $year,
            'text' => $text,
        ];

    }
    return $values;
}
