<?php

function create_calendar ($user, $schedule, &$head, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $id = $schedule->id;

    $head .= '<link rel="stylesheet" type="text/css"'
        ." href=\"$base../../calendar.css?2\" />";

    include_once "$fnsDir/request_strings.php";
    list($year, $month) = request_strings('year', 'month');

    include_once "$fnsDir/user_time_today.php";
    $timeToday = user_time_today($user);

    $yearToday = (int)date('Y', $timeToday);
    $monthToday = (int)date('n', $timeToday);

    $year = $year === '' ? $yearToday : (int)$year;
    $month = $month === '' ? $monthToday : (int)$month;

    $timeSelected = mktime(0, 0, 0, $month, 1, $year);
    $yearSelected = date('Y', $timeSelected);
    $monthSelected = date('n', $timeSelected);

    $monthStartTime = mktime(0, 0, 0, $monthSelected, 1, $yearSelected);
    $calendarStartTime = mktime(0, 0, 0, $monthSelected,
        1 - date('w', $monthStartTime), $yearSelected);
    $nextMonthStartTime = mktime(0, 0, 0, $monthSelected + 1, 1, $yearSelected);
    $prevMonthStartTime = mktime(0, 0, 0, $monthSelected - 1, 1, $yearSelected);

    $prevMonthYear = date('Y', $prevMonthStartTime);
    $prevMonth = date('n', $prevMonthStartTime);
    $prevMonthHref = "?id=$id&year=$prevMonthYear&amp;month=$prevMonth";

    $nextMonthYear = date('Y', $nextMonthStartTime);
    $nextMonth = date('n', $nextMonthStartTime);
    $nextMonthHref = "?id=$id&year=$nextMonthYear&amp;month=$nextMonth";

    $calendarText = date('F', $timeSelected);
    if ($yearSelected != date('Y', $timeToday)) {
        $calendarText .= ', '.date('Y', $timeSelected);
    }

    $html =
        '<div class="navigation">'
            ."<a href=\"$prevMonthHref\""
            .' class="clickable navigation-arrow left">'
                .'<span class="navigation-arrow-icon icon arrow-left"></span>'
            .'</a>'
            ."<div class=\"navigation-center\">$calendarText</div>"
            ."<a href=\"$nextMonthHref\""
            .' class="clickable navigation-arrow right">'
                .'<span class="navigation-arrow-icon icon arrow-right"></span>'
            .'</a>'
        .'</div>'
        .'<div class="calendar-columns">'
            .'<span class="calendar-week calendar-column column0">Sun</span>'
            .'<span class="calendar-week calendar-column column1">Mon</span>'
            .'<span class="calendar-week calendar-column column2">Tue</span>'
            .'<span class="calendar-week calendar-column column3">Wed</span>'
            .'<span class="calendar-week calendar-column column4">Thu</span>'
            .'<span class="calendar-week calendar-column column5">Fri</span>'
            .'<span class="calendar-week calendar-column column6">Sat</span>'
        .'</div>'
        .'<div>';
    $time = $calendarStartTime;
    $daystamp = $time / (60 * 60 * 24);
    for ($i = 0; $i < 6; $i++) {
        $html .=
            '<div class="hr"></div>'
            .'<div class="calendar-columns">';
        for ($j = 0; $j < 7; $j++) {

            $day = date('j', $time);

            $offmonth = $time < $monthStartTime || $time >= $nextMonthStartTime;
            if ($offmonth) $offmonthClass = ' offmonth';
            else $offmonthClass = '';

            $dayHtml = $day;
            if ($time == $timeToday) {
                $dayHtml = "<span class=\"colorText red\">$dayHtml</span>";
            }
            if ($offmonth) {
                $dayHtml = "<span class=\"colorText grey\">$dayHtml</span>";
            }
            if (($daystamp - $schedule->offset) % $schedule->interval == 0) {
                $dayHtml =
                    "<span class=\"calendar-day-busyRing$offmonthClass\">"
                        .$dayHtml
                    .'</span>';
            }

            $html .=
                "<span class=\"calendar-day calendar-column column$j\">"
                    .$dayHtml
                .'</span>';

            $time += 60 * 60 * 24;
            $daystamp++;

        }
        $html .= '</div>';
    }
    $html .= '</div>';

    return $html;

}
