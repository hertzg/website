<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';
    $id_users = $user->id_users;

    include_once "$fnsDir/request_strings.php";

    list($all) = request_strings('all');

    if ($all) {
        include_once "$fnsDir/ReceivedContacts/indexOnReceiver.php";
        $receivedContacts = ReceivedContacts\indexOnReceiver(
            $mysqli, $id_users);
    } else {
        include_once "$fnsDir/ReceivedContacts/indexNotArchivedOnReceiver.php";
        $receivedContacts = ReceivedContacts\indexNotArchivedOnReceiver(
            $mysqli, $id_users);
    }

    include_once "$fnsDir/create_sender_description.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";

    $items = [];
    if ($receivedContacts) {
        foreach ($receivedContacts as $receivedContact) {

            if ($receivedContact->favorite) $icon = 'favorite-contact';
            else $icon = 'contact';

            $title = htmlspecialchars($receivedContact->full_name);
            $description = create_sender_description($receivedContact);
            $href = "{$base}view/?id=$receivedContact->id";
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, $icon);

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No received contacts');
    }

    if (!$all && $user->num_archived_received_contacts) {
        include_once "$fnsDir/Page/buttonLink.php";
        $items[] = Page\buttonLink('Show Archived Contacts', '?all=1');
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $title = 'Delete All Contacts';
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
                'title' => 'Contacts',
                'href' => "$base..",
            ],
        ],
        'Received',
        Page\sessionMessages('contacts/received/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteAllLink),
        create_new_item_button('Contact', "$base../")
    );

}
