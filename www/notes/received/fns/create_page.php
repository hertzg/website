<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($all) = request_strings('all');

    if ($all) {
        include_once "$fnsDir/ReceivedNotes/indexOnReceiver.php";
        $receivedNotes = ReceivedNotes\indexOnReceiver($mysqli, $id_users);
    } else {
        include_once "$fnsDir/ReceivedNotes/indexNotArchivedOnReceiver.php";
        $receivedNotes = ReceivedNotes\indexNotArchivedOnReceiver(
            $mysqli, $id_users);
    }

    $items = [];

    if ($receivedNotes) {

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('dateAgo', "$base../../");

        include_once "$fnsDir/create_sender_description.php";
        include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($receivedNotes as $receivedNote) {

            $id = $receivedNote->id;
            $options = ['id' => $id];

            $title = $receivedNote->title;
            if ($receivedNote->encrypt_in_listings) {
                include_once "$fnsDir/encrypt_text.php";
                $title = encrypt_text($title);
                $icon = 'encrypted-note';
            } else {
                $icon = 'note';
            }

            $title = htmlspecialchars($title);
            $description = create_sender_description($receivedNote);
            $href = "{$base}view/".ItemList\Received\escapedItemQuery($id);
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, $icon, $options);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No received notes');
    }

    if (!$all && $user->num_archived_received_notes) {
        include_once "$fnsDir/Page/buttonLink.php";
        $items[] = Page\buttonLink('Show Archived Notes', '?all=1');
    }

    include_once "$fnsDir/ItemList/Received/escapedPageQuery.php";
    include_once "$fnsDir/Page/imageLink.php";
    $href = "{$base}delete-all/".ItemList\Received\escapedPageQuery();
    $deleteAllLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Notes', $href, 'trash-bin')
        .'</div>';

    include_once __DIR__.'/create_tabs.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return Page\create(
        [
            'title' => 'Home',
            'href' => "$base../../home/#notes",
        ],
        'Notes',
        create_tabs($user)
        .Page\sessionErrors('notes/received/errors')
        .Page\sessionMessages('notes/received/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteAllLink),
        create_new_item_button('Note', "$base../")
    );

}
