<?php

namespace SearchPage;

function renderEvents ($events, &$items, $keyword) {

    $fnsDir = __DIR__.'/../../../../fns';

    if ($events) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/ItemList/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($events as $event) {

            $id = $event->id;

            $title = htmlspecialchars($event->text);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);

            $description = date('F d, Y', $event->event_time);
            $escapedItemQuery = \ItemList\escapedItemQuery($id);

            $items[] = \Page\imageArrowLinkWithDescription($title, $description,
                "../view/$escapedItemQuery", 'event', ['id' => $id]);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No events found');
    }

}
