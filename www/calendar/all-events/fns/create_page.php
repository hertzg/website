<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset();

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    $items = [];

    if ($user->num_events) {

        include_once "$fnsDir/SearchForm/emptyContent.php";
        $formContent = SearchForm\emptyContent('Search events...');

        include_once "$fnsDir/SearchForm/create.php";
        $items[] = SearchForm\create('search/', $formContent);

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('searchForm', "$base../../");

    }

    include_once "$fnsDir/Events/indexPageOnUser.php";
    $events = Events\indexPageOnUser($mysqli,
        $user->id_users, $offset, $limit, $total);

    include_once __DIR__.'/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($events as $event) {
        $id = $event->id;
        $description = date('F d, Y', $event->event_time);
        $items[] = Page\imageArrowLinkWithDescription(
            htmlspecialchars($event->text), $description,
            "{$base}view/".ItemList\escapedItemQuery($id),
            'event', ['id' => $id]);
    }

    include_once __DIR__.'/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Events',
                "{$base}delete-all/$escapedPageQuery", 'trash-bin')
        .'</div>';

    unset(
        $_SESSION['calendar/all-events/new/errors'],
        $_SESSION['calendar/all-events/new/values'],
        $_SESSION['calendar/all-events/view/messages'],
        $_SESSION['calendar/errors'],
        $_SESSION['calendar/messages']
    );

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
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
            Page\sessionErrors('calendar/all-events/errors')
            .Page\sessionMessages('calendar/all-events/messages')
            .join('<div class="hr"></div>', $items),
            Page\newItemButton("{$base}new/$escapedPageQuery", 'Event')
        )
        .create_panel('Options', $deleteLink);

}
