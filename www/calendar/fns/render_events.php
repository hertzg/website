<?php

function render_events (array $events, array &$eventItems) {
    if ($events) {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        foreach ($events as $event) {
            $title = htmlspecialchars($event->eventtext);
            $href = "view-event/?idevents=$event->idevents";
            $eventItems[] = Page\imageArrowLink($title, $href, 'event');
        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $eventItems[] = Page\info('No events on this day');
    }
}
