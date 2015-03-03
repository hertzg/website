<?php

namespace ViewPage;

function renderEvent ($event, &$items) {

    include_once __DIR__.'/../../../fns/Page/text.php';
    $items[] = \Page\text(htmlspecialchars($event->text));
    $items[] = \Page\text(date('F d, Y', $event->event_time));

}
