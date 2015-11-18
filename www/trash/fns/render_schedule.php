<?php

function render_schedule ($schedule, $description, $href, $options, &$items) {
    $title = htmlspecialchars($schedule->text);
    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, 'schedule', $options);
}
