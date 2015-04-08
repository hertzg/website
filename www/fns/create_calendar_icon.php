<?php

function create_calendar_icon ($day) {
    return
        '<span class="icon calendar">'
            ."<span class=\"calendarIcon-day\">$day</span>"
        .'</span>';
}
