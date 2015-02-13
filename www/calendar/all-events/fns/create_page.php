<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset();

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    $items = [];

    include_once "$fnsDir/Events/indexPageOnUser.php";
    $events = Events\indexPageOnUser($mysqli,
        $user->id_users, $offset, $limit, $total);

    include_once __DIR__.'/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($events as $event) {
        $description = date('F d, Y', $event->event_time);
        $items[] = Page\imageArrowLinkWithDescription(
            htmlspecialchars($event->text),
            $description, "$base../view-event/?id=$event->id", 'event');
    }

    include_once __DIR__.'/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Events',
                "{$base}delete-all/", 'trash-bin')
        .'</div>';

    unset(
        $_SESSION['calendar/all-events/new/errors'],
        $_SESSION['calendar/all-events/new/values'],
        $_SESSION['calendar/errors'],
        $_SESSION['calendar/messages']
    );

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Calendar',
                    'href' => "$base../#all-events",
                ],
            ],
            'All Events',
            join('<div class="hr"></div>', $items),
            Page\newItemButton('new/', 'Event')
        )
        .create_panel('Options', $deleteLink);

}
