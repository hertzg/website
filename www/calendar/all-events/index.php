<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

if (!$user->num_events) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

$items = [];

include_once '../../fns/Events/indexOnUser.php';
include_once '../../lib/mysqli.php';
$events = Events\indexOnUser($mysqli, $user->id_users);

if ($events) {

    include_once '../../fns/Page/imageArrowLinkWithDescription.php';
    foreach ($events as $event) {
        $description = date('F d, Y', $event->event_time);
        $items[] = Page\imageArrowLinkWithDescription(
            htmlspecialchars($event->event_text),
            $description, "../view-event/?id=$event->id", 'event');
    }

    include_once '../../fns/create_panel.php';
    include_once '../../fns/Page/imageArrowLink.php';
    $optionsPanel = create_panel(
        'Options',
        Page\imageArrowLink('Delete All Events', 'delete-all/', 'trash-bin')
    );

} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No events');
    $optionsPanel = '';
}

unset(
    $_SESSION['calendar/errors'],
    $_SESSION['calendar/messages']
);

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/tabs.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ],
            [
                'title' => 'Calendar',
                'href' => '..',
            ],
        ],
        'All Events',
        join('<div class="hr"></div>', $items)
    )
    .$optionsPanel;

include_once '../../fns/echo_page.php';
echo_page($user, 'All Events', $content, $base);
