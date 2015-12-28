<?php

namespace ViewPage;

function create ($user, $event, &$scripts) {

    $id = $event->id;
    $event_time = $event->event_time;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($keyword) = request_strings('keyword');

    include_once "$fnsDir/str_collapse_spaces.php";
    $keyword = str_collapse_spaces($keyword);

    if ($keyword === '') {
        include_once __DIR__.'/../../../fns/ViewPage/viewContent.php';
        $viewContent = viewContent($event, $scripts, '../');
    } else {
        include_once __DIR__.'/markedViewContent.php';
        $viewContent = markedViewContent($event, $scripts, $keyword);
    }

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-event', ['id' => 'edit']);

    $params = [
        'event_time' => $event_time,
        'text' => $event->text,
    ];
    $start_hour = $event->start_hour;
    if ($start_hour !== null) {
        $params['start_hour'] = $start_hour;
        $params['start_minute'] = $event->start_minute;
    }
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink(
        'Duplicate', $href, 'duplicate-event');

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete',
                "../delete/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once "$fnsDir/user_time_today.php";
    $user_time_today = user_time_today($user);

    $newEventParams = [];
    if ($event_time != $user_time_today) {
        $newEventParams['event_time'] = $event_time;
    }

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = \ItemList\escapedPageQuery($newEventParams);

    unset(
        $_SESSION['calendar/all-events/edit/errors'],
        $_SESSION['calendar/all-events/edit/values'],
        $_SESSION['calendar/all-events/errors'],
        $_SESSION['calendar/all-events/messages'],
        $_SESSION['calendar/all-events/new/errors'],
        $_SESSION['calendar/all-events/new/values']
    );

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'All Events',
                'href' => \ItemList\listHref()."#$id",
            ],
            "Event #$id",
            \Page\sessionMessages('calendar/all-events/view/messages')
            .$viewContent,
            \Page\newItemButton("../new/$escapedPageQuery", 'Event')
        )
        .create_panel('Event Options', $optionsContent);

}
