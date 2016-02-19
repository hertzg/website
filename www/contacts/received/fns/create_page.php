<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

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

    $items = [];

    if ($receivedContacts) {

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('dateAgo', "$base../../");

        include_once "$fnsDir/create_sender_description.php";
        include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($receivedContacts as $receivedContact) {

            $id = $receivedContact->id;
            $options = ['id' => $id];

            if ($receivedContact->favorite) $icon = 'favorite-contact';
            else $icon = 'contact';

            $title = htmlspecialchars($receivedContact->full_name);
            $description = create_sender_description($receivedContact);
            $href = "{$base}view/".ItemList\Received\escapedItemQuery($id);
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, $icon, $options);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No received contacts');
    }

    if (!$all && $user->num_archived_received_contacts) {
        include_once "$fnsDir/Page/buttonLink.php";
        $items[] = Page\buttonLink('Show Archived Contacts', '?all=1');
    }

    include_once "$fnsDir/ItemList/Received/escapedPageQuery.php";
    include_once "$fnsDir/Page/imageLink.php";
    $href = "{$base}delete-all/".ItemList\Received\escapedPageQuery();
    $deleteAllLink = Page\imageLink('Delete All Contacts',
        $href, 'trash-bin', ['id' => 'delete-all']);

    include_once __DIR__.'/create_tabs.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Home',
                'href' => "$base../../home/#contacts",
                'localNavigation' => true,
            ],
            'Contacts',
            create_tabs($user)
            .Page\sessionErrors('contacts/received/errors')
            .Page\sessionMessages('contacts/received/messages')
            .join('<div class="hr"></div>', $items),
            create_new_item_button('Contact', "$base../")
        )
        .create_panel('Options', $deleteAllLink);

}
