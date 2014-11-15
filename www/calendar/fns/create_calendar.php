<?php

function create_calendar ($mysqli, $id_users, $timeSelected) {

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
        .'<div class="calendar-columns calendar-weeks">'
            .'<div>Sun</div>'
            .'<div>Mon</div>'
            .'<div>Tue</div>'
            .'<div>Wed</div>'
            .'<div>Thu</div>'
            .'<div>Fri</div>'
            .'<div>Sat</div>'
        .'</div>'
        .'<div>';

    $time = $calendarStartTime;
    for ($i = 0; $i < 6; $i++) {
        $html .=
            '<div class="hr"></div>'
            .'<div class="calendar-columns calendar-days">';
        for ($j = 0; $j < 7; $j++) {
            $year = date('Y', $time);
            $month = date('n', $time);
            $day = date('j', $time);
            $html .= "<a href=\"?year=$year&amp;month=$month&amp;day=$day\"";
            if ($time == $timeSelected) {
                $html .= ' class="calendar-today">';
            } elseif ($time < $monthStartTime || $time >= $nextMonthStartTime) {
                $html .= ' class="calendar-offmonth">';
            } else {
                $html .= '>';
            }
            if (array_key_exists($time, $busyTimes)) {
                $html .= "<span class=\"busy\">$day</span>";
            } else {
                $html .= $day;
            }
            $html .= '</a>';
            $time += 60 * 60 * 24;
        }
        $html .= '</div>';
    }
    $html .= '</div>';
    return $html;

}
