<?php

function render_schedule ($schedule, &$title, &$icon) {
    $title = htmlspecialchars($schedule->text);
    $icon = 'schedule';
}
