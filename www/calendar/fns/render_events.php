<?php

function render_events (array $events, array &$eventItems) {
    if ($events) {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        foreach ($events as $event) {
            $title = htmlspecialchars($event->event_text);
            $href = "view-event/?id_events=$event->id_events";
            $eventItems[] = Page\imageArrowLink($title, $href, 'event');
        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $eventItems[] = Page\info('No events on this day');
    }
}
