<?php

include_once 'fns/require_received_tasks.php';
$user = require_received_tasks();
$id_users = $user->id_users;

include_once '../../fns/Users/Tasks/Received/clearNumberNew.php';
include_once '../../lib/mysqli.php';
Users\Tasks\Received\clearNumberNew($mysqli, $id_users);

unset(
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages'],
    $_SESSION['tasks/received/view/messages']
);

include_once '../../fns/request_strings.php';
list($all) = request_strings('all');

if ($all) {
    include_once '../../fns/ReceivedTasks/indexOnReceiver.php';
    $receivedTasks = ReceivedTasks\indexOnReceiver($mysqli, $id_users);
} else {
    include_once '../../fns/ReceivedTasks/indexNotArchivedOnReceiver.php';
    $receivedTasks = ReceivedTasks\indexNotArchivedOnReceiver(
        $mysqli, $id_users);
}

include_once '../../fns/create_sender_description.php';
include_once '../../fns/Page/imageArrowLinkWithDescription.php';

$items = [];

if ($receivedTasks) {
    foreach ($receivedTasks as $receivedTask) {

        if ($receivedTask->top_priority) $icon = 'task-top-priority';
        else $icon = 'task';

        $title = htmlspecialchars($receivedTask->text);
        $description = create_sender_description($receivedTask);
        $href = "view/?id=$receivedTask->id";
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);

    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No received tasks');
}

if (!$all && $user->num_archived_received_tasks) {
    include_once '../../fns/Page/buttonLink.php';
    $items[] = Page\buttonLink('Show Archived Tasks', '?all=1');
}

include_once '../../fns/Page/imageArrowLink.php';
$title = 'Delete All Tasks';
$deleteAllLink = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

include_once '../../fns/create_new_item_button.php';
include_once '../../fns/create_panel.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Tasks',
            'href' => '..',
        ],
    ],
    'Received',
    Page\sessionMessages('tasks/received/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', $deleteAllLink),
    create_new_item_button('Task', '../')
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Tasks', $content, '../../');
