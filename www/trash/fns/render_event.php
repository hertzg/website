<?php

function render_event ($event, &$title, &$icon) {
    $title = htmlspecialchars($event->text);
    $icon = 'event';
}
