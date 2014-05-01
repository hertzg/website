<?php

function render_birthday ($birthday_time, &$items, $base = '') {
    if ($birthday_time !== null) {

        $title = date('F d, Y', $birthday_time);

        $day = date('j', $birthday_time);
        $month = date('n', $birthday_time);
        $year = date('Y', $birthday_time);
        $href = "$base../../calendar/?day=$day&amp;month=$month&amp;year=$year";

        include_once __DIR__.'/../../fns/Form/link.php';
        $items[] = Form\link('Birth date', $title, $href, 'calendar');

    }
}
