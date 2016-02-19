<?php

namespace SearchPage;

function create ($mysqli, $user, &$scripts) {

    $base = '../../../';
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('searchForm', $base);

    include_once "$fnsDir/request_valid_keyword_tag_offset.php";
    list($keyword, $tag, $offset) = request_valid_keyword_tag_offset();

    include_once "$fnsDir/Paging/limit.php";
    $limit = \Paging\limit();

    include_once "$fnsDir/Users/Events/searchPage.php";
    $events = \Users\Events\searchPage($mysqli, $user,
        $keyword, $offset, $limit, $total, $user->events_order_by);

    include_once "$fnsDir/SearchForm/content.php";
    $formContent = \SearchForm\content($keyword, 'Search events...', '../');

    include_once "$fnsDir/SearchForm/create.php";
    $items = [\SearchForm\create('./', $formContent)];

    $params = ['keyword' => $keyword];

    include_once "$fnsDir/check_offset_overflow.php";
    check_offset_overflow($offset, $limit, $total, $params);

    include_once __DIR__.'/../render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/renderEvents.php';
    renderEvents($events, $items, $keyword);

    include_once __DIR__.'/../render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    unset(
        $_SESSION['calendar/all-events/new/errors'],
        $_SESSION['calendar/all-events/new/values'],
        $_SESSION['calendar/all-events/view/messages'],
        $_SESSION['calendar/view-event/errors'],
        $_SESSION['calendar/view-event/messages']
    );

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = \ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink = \Page\imageLink('Delete All Events',
        "../delete-all/$escapedPageQuery", 'trash-bin', ['id' => 'delete-all']);

    include_once __DIR__.'/../sort_panel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Calendar',
                'href' => '../../#all-events',
            ],
            'All Events',
            \Page\sessionMessages('calendar/all-events/messages')
            .join('<div class="hr"></div>', $items),
            \Page\newItemButton("../new/$escapedPageQuery", 'Event')
        )
        .sort_panel($user, $total, '../')
        .create_panel('Options', $deleteLink);

}
