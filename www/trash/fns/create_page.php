<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/DeletedItems/expireDays.php";
    $expireDays = DeletedItems\expireDays();

    $items = [];

    if ($user->num_deleted_items) {

        include_once "$fnsDir/DeletedItems/indexOnUser.php";
        $deletedItems = DeletedItems\indexOnUser($mysqli, $user->id_users);

        include_once "$fnsDir/date_ago.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($deletedItems as $deletedItem) {

            $type = $deletedItem->data_type;
            $data = json_decode($deletedItem->data_json);

            $description = 'Deleted '.date_ago($deletedItem->insert_time);

            $href = "{$base}view/?id=$deletedItem->id";

            if ($type == 'bookmark' || $type == 'receivedBookmark') {
                include_once __DIR__.'/render_bookmark.php';
                render_bookmark($data, $description, $href, $items);
            } elseif ($type == 'contact' || $type == 'receivedContact') {
                include_once __DIR__.'/render_contact.php';
                render_contact($data, $description, $href, $items);
            } elseif ($type == 'note' || $type == 'receivedNote') {
                include_once __DIR__.'/render_note.php';
                render_note($data, $description, $href, $items);
            } elseif ($type == 'file' || $type == 'receivedFile') {
                include_once __DIR__.'/render_file.php';
                render_file($data, $description, $href, $items);
            } elseif ($type == 'folder' || $type == 'receivedFolder') {
                include_once __DIR__.'/render_folder.php';
                render_folder($data, $description, $href, $items);
            } elseif ($type == 'task' || $type == 'receivedTask') {
                include_once __DIR__.'/render_task.php';
                render_task($data, $description, $href, $items);
            }

        }

        include_once "$fnsDir/Page/imageArrowLink.php";
        $href = "{$base}empty/";
        $emptyLink =
            '<div id="emptyLink">'
                .Page\imageArrowLink('Empty Trash', $href, 'empty-trash')
            .'<?div>';

        include_once "$fnsDir/create_panel.php";
        include_once "$fnsDir/Page/text.php";
        $optionsPanel = create_panel('Options', $emptyLink);

    } else {

        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('Trash is empty');

        $optionsPanel = '';

    }

    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => "$base../home/",
            ],
        ],
        'Trash',
        Page\sessionErrors('trash/errors')
        .Page\sessionMessages('trash/messages')
        .join('<div class="hr"></div>', $items)
        .Page\infoText('Items in Trash are automatically'
            ." purged in $expireDays days after deletion.")
        .$optionsPanel
    );

}