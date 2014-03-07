<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../lib/page.php';

$items = array();

include_once '../../fns/Events/indexOnUser.php';
include_once '../../fns/Events/indexOnUser.php';
$events = Events\indexOnUser($mysqli, $idusers);
if ($events) {

    include_once '../../fns/Page/imageArrowLinkWithDescription.php';
    foreach ($events as $event) {
        $description = date('F d, Y', $event->eventtime);
        $items[] = Page\imageArrowLinkWithDescription(
            htmlspecialchars($event->eventtext),
            $description, "../view-event/?idevents=$event->idevents", 'event');
    }

    include_once '../../fns/create_panel.php';
    include_once '../../fns/Page/imageArrowLink.php';
    $optionsPanel = create_panel(
        'Options',
        Page\imageArrowLink('Delete All Events', 'delete-all/', 'trash-bin')
    );

} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No events.');
    $optionsPanel = '';
}

unset($_SESSION['calendar/index_messages']);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';

$page->title = 'All Events';
$page->base = '../../';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Calendar',
                'href' => '..',
            ),
        ),
        'All Events',
        join('<div class="hr"></div>', $items)
    )
    .$optionsPanel
);
