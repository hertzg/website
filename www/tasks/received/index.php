<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

if (!$user->num_received_tasks) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

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
$icon = 'task';
foreach ($receivedTasks as $receivedTask) {
    $href = "view/?id=$receivedTask->id";
    $tags = $receivedTask->tags;
    $title = htmlspecialchars($receivedTask->text);
    if ($tags === '') {
        $items[] = Page\imageArrowLink($title, $href, $icon);
    } else {
        $description = 'Tags: '.htmlspecialchars($tags);
        $items[] = Page\imageArrowLinkWithDescription($title, $description, $href, $icon);
    }
}

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content = create_tabs(
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
    Page\sessionMessages('contacts/received/messages')
    .    join('<div class="hr"></div>', $items)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Tasks', $content, $base);
