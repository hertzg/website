<?php

function create_all_events_link ($user) {
    $title = 'All Events';
    $href = 'all-events/';
    $icon = 'event';
    $num_events = $user->num_events;
    if ($num_events) {
        $description = "$num_events total.";
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        return Page\imageArrowLinkWithDescription($title, $description,
            $href, $icon);
    }
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    return Page\imageArrowLink($title, $href, $icon);
}
