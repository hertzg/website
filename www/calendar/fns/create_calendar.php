<?php

function create_calendar ($mysqli, $id_users,
    $timeSelected, $timeToday, $day_is_selected) {

    $monthSelected = date('n', $timeSelected);
    $yearSelected = date('Y', $timeSelected);

    $monthStartTime = mktime(0, 0, 0, $monthSelected, 1, $yearSelected);
    $calendarStartTime = mktime(0, 0, 0, $monthSelected,
        1 - date('w', $monthStartTime), $yearSelected);
    $nextMonthStartTime = mktime(0, 0, 0, $monthSelected + 1, 1, $yearSelected);
    $prevMonthStartTime = mktime(0, 0, 0, $monthSelected - 1, 1, $yearSelected);

    $prevMonthYear = date('Y', $prevMonthStartTime);
    $prevMonth = date('n', $prevMonthStartTime);
    $prevMonthHref = "?year=$prevMonthYear&amp;month=$prevMonth";

    $nextMonthYear = date('Y', $nextMonthStartTime);
    $nextMonth = date('n', $nextMonthStartTime);
    $nextMonthHref = "?year=$nextMonthYear&amp;month=$nextMonth";

    include_once __DIR__.'/get_busy_times.php';
    $busyTimes = get_busy_times($mysqli, $id_users, $calendarStartTime,
        $monthStartTime, $nextMonthStartTime, $monthSelected, $yearSelected);

    $html =
        '<div class="navigation">'
            ."<a href=\"$prevMonthHref\" class=\"clickable arrow left\">"
                .'<span class="icon arrow-left"></span>'
            .'</a>'
            .'<div class="center">'
                .date('F d, Y', $timeSelected)
            .'</div>'
            ."<a href=\"$nextMonthHref\" class=\"clickable arrow right\">"
                .'<span class="icon arrow-right"></span>'
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
    for ($i = 0; $i < 6; $i++) {
        $html .=
            '<div class="hr"></div>'
            .'<div class="calendar-columns">';
        for ($j = 0; $j < 7; $j++) {

            $year = date('Y', $time);
            $month = date('n', $time);
            $day = date('j', $time);

            $offmonth = $time < $monthStartTime || $time >= $nextMonthStartTime;
            if ($offmonth) $offmonthClass = ' offmonth';
            else $offmonthClass = '';

            $dayHtml = $day;
            if ($time == $timeToday) {
                $dayHtml = "<span class=\"redText\">$dayHtml</span>";
            }
            if ($offmonth) {
                $dayHtml =
                    '<span class="calendar-day-offmonth">'
                        .$dayHtml
                    .'</span>';
            }
            if (array_key_exists($time, $busyTimes)) {
                $dayHtml =
                    "<span class=\"calendar-day-busyRing$offmonthClass\">"
                        .$dayHtml
                    .'</span>';
            }
            $class = "clickable calendar-day calendar-column column$j";
            if ($day_is_selected && $time == $timeSelected) {
                $class .= ' active';
            }

            $href = "?year=$year&amp;month=$month&amp;day=$day";
            $html .= "<a class=\"$class\" href=\"$href\">$dayHtml</a>";

            $time += 60 * 60 * 24;

        }
        $html .= '</div>';
    }
    $html .= '</div>';
    return $html;

}
