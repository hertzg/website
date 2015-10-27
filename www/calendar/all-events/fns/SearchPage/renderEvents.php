<?php

namespace SearchPage;

function renderEvents ($events, &$items, $keyword) {

    $fnsDir = __DIR__.'/../../../../fns';

    if ($events) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/format_event_time.php";
        include_once "$fnsDir/ItemList/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($events as $event) {

            $id = $event->id;

            $title = htmlspecialchars($event->text);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);

            $escapedItemQuery = \ItemList\escapedItemQuery($id);

            $items[] = \Page\imageArrowLinkWithDescription($title,
                format_event_time($event), "../view/$escapedItemQuery",
                'event', ['id' => $id]);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No events found');
    }

}
