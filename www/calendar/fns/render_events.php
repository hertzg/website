<?php

function render_events (array $contacts, array $events, &$items) {
    $items = [];
    if ($events || $contacts) {
        if ($contacts) {
            include_once '../fns/Page/imageLink.php';
            foreach ($contacts as $contact) {
                $title = 'Birthday of '.htmlspecialchars($contact->full_name);
                $href = "../contacts/view/?id=$contact->id_contacts";
                $items[] = Page\imageLink($title, $href, 'birthday-cake');
            }
        }
        if ($events) {
            include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
            foreach ($events as $event) {
                $title = htmlspecialchars($event->text);
                $href = "view-event/?id=$event->id";
                $items[] = Page\imageArrowLink($title, $href, 'event');
            }
        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('No events on this day');
    }
}
