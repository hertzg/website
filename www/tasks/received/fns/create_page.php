<?php

function create_page ($mysqli, $user, $base = '') {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($all) = request_strings('all');

    if ($all) {
        include_once "$fnsDir/ReceivedTasks/indexOnReceiver.php";
        $receivedTasks = ReceivedTasks\indexOnReceiver($mysqli, $id_users);
    } else {
        include_once "$fnsDir/ReceivedTasks/indexNotArchivedOnReceiver.php";
        $receivedTasks = ReceivedTasks\indexNotArchivedOnReceiver(
            $mysqli, $id_users);
    }

    include_once "$fnsDir/create_sender_description.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";

    $items = [];

    if ($receivedTasks) {
        foreach ($receivedTasks as $receivedTask) {

            if ($receivedTask->top_priority) $icon = 'task-top-priority';
            else $icon = 'task';

            $title = htmlspecialchars($receivedTask->text);
            $description = create_sender_description($receivedTask);
            $href = "{$base}view/?id=$receivedTask->id";
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, $icon);

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No received tasks');
    }

    if (!$all && $user->num_archived_received_tasks) {
        include_once "$fnsDir/Page/buttonLink.php";
        $items[] = Page\buttonLink('Show Archived Tasks', '?all=1');
    }

    include_once "$fnsDir/Page/imageLink.php";
    $title = 'Delete All Tasks';
    $deleteAllLink =
        '<div id="deleteAllLink">'
            .Page\imageLink($title, "{$base}delete-all/", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Tasks',
                'href' => "{$base}..",
            ],
        ],
        'Received',
        Page\sessionMessages('tasks/received/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteAllLink),
        create_new_item_button('Task', "{$base}../")
    );

}
