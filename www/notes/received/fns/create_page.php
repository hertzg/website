<?php

function create_page ($mysqli, $user, $base = '') {

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

    include_once "$fnsDir/create_sender_description.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";

    $items = [];

    if ($receivedNotes) {
        foreach ($receivedNotes as $receivedNote) {

            $text = $receivedNote->text;
            if ($receivedNote->encrypt) {
                include_once "$fnsDir/encrypt_text.php";
                $text = encrypt_text($text);
                $icon = 'encrypted-note';
            } else {
                $icon = 'note';
            }

            $title = htmlspecialchars($text);
            $description = create_sender_description($receivedNote);
            $href = "{$base}view/?id=$receivedNote->id";
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, $icon);

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No received notes');
    }

    if (!$all && $user->num_archived_received_notes) {
        include_once "$fnsDir/Page/buttonLink.php";
        $items[] = Page\buttonLink('Show Archived Notes', '?all=1');
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $title = 'Delete All Notes';
    $deleteAllLink =
        '<div id="deleteAllLink">'
            .Page\imageArrowLink($title, "{$base}delete-all/", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Notes',
                'href' => "$base..",
            ],
        ],
        'Received',
        Page\sessionMessages('notes/received/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteAllLink),
        create_new_item_button('Note', "$base../")
    );

}