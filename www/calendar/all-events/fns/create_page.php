<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset();

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    $items = [];

    if ($user->num_events > 1) {

        include_once "$fnsDir/SearchForm/emptyContent.php";
        $formContent = SearchForm\emptyContent('Search events...');

        include_once "$fnsDir/SearchForm/create.php";
        $items[] = SearchForm\create('search/', $formContent);

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('searchForm', "$base../../");

    }

    include_once "$fnsDir/Events/indexPageOnUser.php";
    $events = Events\indexPageOnUser($mysqli, $user->id_users,
        $offset, $limit, $total, $user->events_order_by);

    include_once __DIR__.'/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once "$fnsDir/format_event_time.php";
    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($events as $event) {
        $id = $event->id;
        $items[] = Page\imageArrowLinkWithDescription(
            htmlspecialchars($event->text), format_event_time($event),
            "{$base}view/".ItemList\escapedItemQuery($id),
            'event', ['id' => $id]);
    }

    include_once __DIR__.'/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink = Page\imageLink('Delete All Events',
        "{$base}delete-all/$escapedPageQuery",
        'trash-bin', ['id' => 'delete-all']);

    unset(
        $_SESSION['calendar/all-events/new/errors'],
        $_SESSION['calendar/all-events/new/values'],
        $_SESSION['calendar/all-events/view/messages'],
        $_SESSION['calendar/errors'],
        $_SESSION['calendar/messages']
    );

    include_once __DIR__.'/sort_panel.php';
    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Calendar',
                'href' => "$base../#all-events",
            ],
            'All Events',
            Page\sessionErrors('calendar/all-events/errors')
            .Page\sessionMessages('calendar/all-events/messages')
            .join('<div class="hr"></div>', $items),
            Page\newItemButton("{$base}new/$escapedPageQuery", 'Event')
        )
        .sort_panel($user, $total, $base)
        .Page\panel('Options', $deleteLink);

}
