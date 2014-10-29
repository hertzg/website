<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    $items = [];

    include_once "$fnsDir/Events/indexOnUser.php";
    $events = Events\indexOnUser($mysqli, $user->id_users);

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($events as $event) {
        $description = date('F d, Y', $event->event_time);
        $items[] = Page\imageArrowLinkWithDescription(
            htmlspecialchars($event->text),
            $description, "$base../view-event/?id=$event->id", 'event');
    }

    include_once "$fnsDir/Page/imageLink.php";
    $href = "{$base}delete-all/";
    $deleteLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Events', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Calendar',
                    'href' => "$base..",
                ],
            ],
            'All Events',
            join('<div class="hr"></div>', $items)
        )
        .create_panel('Options', $deleteLink);

}
