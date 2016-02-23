<?php

function render_birthday ($user, $birthday_time, &$items, &$head, $base) {

    if ($birthday_time === null) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_css_link.php";
    $head .= compressed_css_link('calendarIcon', "$base../../");

    $day = date('j', $birthday_time);
    $month = date('n', $birthday_time);
    $year = date('Y', $birthday_time);
    $href = "$base../../calendar/?day=$day&amp;month=$month&amp;year=$year";

    include_once "$fnsDir/user_time_today.php";
    $timeToday = user_time_today($user);

    $monthToday = date('n', $timeToday);

    $age = date('Y', $timeToday) - $year;
    if ($month > $monthToday) $age--;
    elseif ($month == $monthToday && $day > date('j', $timeToday)) $age--;

    include_once "$fnsDir/Form/association.php";
    include_once "$fnsDir/Page/calendarLink.php";
    $items[] = Form\association(
        Page\calendarLink(
            date('F', $birthday_time)." $day, $year (Age $age)", $href, $day),
        'Birthday:'
    );

}
