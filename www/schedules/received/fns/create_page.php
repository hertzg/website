<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';
    $id_users = $user->id_users;

    include_once "$fnsDir/request_strings.php";
    list($all) = request_strings('all');

    if ($all) {
        include_once "$fnsDir/ReceivedSchedules/indexOnReceiver.php";
        $receivedSchedules = ReceivedSchedules\indexOnReceiver(
            $mysqli, $id_users);
    } else {
        include_once "$fnsDir/ReceivedSchedules/indexNotArchivedOnReceiver.php";
        $receivedSchedules = ReceivedSchedules\indexNotArchivedOnReceiver(
            $mysqli, $id_users);
    }

    $items = [];

    if ($receivedSchedules) {

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('dateAgo', "$base../../");

        include_once "$fnsDir/create_sender_description.php";
        include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($receivedSchedules as $receivedSchedule) {

            $id = $receivedSchedule->id;
            $options = ['id' => $id];

            $title = htmlspecialchars($receivedSchedule->text);

            $description = create_sender_description($receivedSchedule);
            $href = "{$base}view/".ItemList\Received\escapedItemQuery($id);
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'schedule', $options);

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No received schedules');
    }

    if (!$all && $user->num_archived_received_schedules) {
        include_once "$fnsDir/Page/buttonLink.php";
        $items[] = Page\buttonLink('Show Archived Schedules', '?all=1');
    }

    include_once "$fnsDir/ItemList/Received/escapedPageQuery.php";
    include_once "$fnsDir/Page/imageLink.php";
    $href = "{$base}delete-all/".ItemList\Received\escapedPageQuery();
    $deleteAllLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Schedules', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Schedules',
                'href' => "$base../#received",
            ],
        ],
        'Received',
        Page\sessionErrors('schedules/received/errors')
        .Page\sessionMessages('schedules/received/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteAllLink),
        create_new_item_button('Schedule', "{$base}../")
    );

}
