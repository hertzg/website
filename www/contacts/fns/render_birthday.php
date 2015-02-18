<?php

function render_birthday ($birthday_time, &$items, &$head, $base) {

    if ($birthday_time === null) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_css_link.php";
    $head .= compressed_css_link('calendarIcon', "$base../../");

    $day = date('j', $birthday_time);
    $month = date('n', $birthday_time);
    $year = date('Y', $birthday_time);
    $href = "$base../../calendar/?day=$day&amp;month=$month&amp;year=$year";

    include_once "$fnsDir/Form/association.php";
    include_once "$fnsDir/create_calendar_icon.php";
    $items[] = Form\association(
        "<a href=\"$href\" class=\"clickable link image_link\">"
            .'<div class="image_link-icon">'
                .create_calendar_icon($day)
            .'</div>'
            .'<div class="image_link-content">'
                .date('F d, Y', $birthday_time)
            .'</div>'
        .'</a>',
        '<label>Birth date:</label>'
    );

}
