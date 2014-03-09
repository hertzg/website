<?php

include_once '../../fns/require_user.php';
require_user('../../');

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
$content =
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
    .$optionsPanel;

include_once '../../fns/echo_page.php';
echo_page($user, 'All Events', $content, '../../');
