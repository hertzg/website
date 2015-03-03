<?php

function render_event ($event, $description, $href, $options, &$items) {

    $title = htmlspecialchars($event->text);

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, 'event', $options);

}
