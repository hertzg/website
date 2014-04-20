<?php

include_once 'fns/require_received_tasks.php';
$user = require_received_tasks();

unset(
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages']
);

include_once '../../fns/ReceivedTasks/indexOnReceiver.php';
include_once '../../lib/mysqli.php';
$receivedTasks = ReceivedTasks\indexOnReceiver($mysqli, $user->id_users);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageArrowLinkWithDescription.php';

$items = [];
foreach ($receivedTasks as $receivedTask) {

    if ($receivedTask->top_priority) {
        $icon = 'task-top-priority';
    } else {
        $icon = 'task';
    }

    $href = "view/?id=$receivedTask->id";
    $tags = $receivedTask->tags;
    $title = htmlspecialchars($receivedTask->text);
    if ($tags === '') {
        $items[] = Page\imageArrowLink($title, $href, $icon);
    } else {
        $description = 'Tags: '.htmlspecialchars($tags);
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    }

}

$title = 'Delete All Tasks';
$deleteAllLink = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Tasks',
            'href' => '..',
        ],
    ],
    'Received',
    Page\sessionMessages('tasks/received/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', $deleteAllLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Tasks', $content, '../../');
