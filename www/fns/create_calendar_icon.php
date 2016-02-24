<?php

function create_calendar_icon ($day, $additionalClass = '') {
    return
        '<span class="icon calendar">'
            ."<span class=\"calendarIcon-day$additionalClass\">$day</span>"
        .'</span>';
}
