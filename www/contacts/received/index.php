<?php

include_once 'fns/require_received_contacts.php';
$user = require_received_contacts();
$id_users = $user->id_users;

include_once '../../fns/Users/Contacts/Received/clearNumberNew.php';
include_once '../../lib/mysqli.php';
Users\Contacts\Received\clearNumberNew($mysqli, $id_users);

unset(
    $_SESSION['contacts/errors'],
    $_SESSION['contacts/messages'],
    $_SESSION['contacts/received/view/messages']
);

include_once '../../fns/request_strings.php';
list($all) = request_strings('all');

if ($all) {
    include_once '../../fns/ReceivedContacts/indexOnReceiver.php';
    $receivedContacts = ReceivedContacts\indexOnReceiver($mysqli, $id_users);
} else {
    include_once '../../fns/ReceivedContacts/indexNotArchivedOnReceiver.php';
    $receivedContacts = ReceivedContacts\indexNotArchivedOnReceiver(
        $mysqli, $id_users);
}

include_once '../../fns/create_sender_description.php';
include_once '../../fns/Page/imageArrowLinkWithDescription.php';

$items = [];
if ($receivedContacts) {
    foreach ($receivedContacts as $receivedContact) {

        if ($receivedContact->favorite) $icon = 'favorite-contact';
        else $icon = 'contact';

        $title = htmlspecialchars($receivedContact->full_name);
        $description = create_sender_description($receivedContact);
        $href = "view/?id=$receivedContact->id";
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);

    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No received contacts');
}

if (!$all && $user->num_archived_received_contacts) {
    include_once '../../fns/Page/buttonLink.php';
    $items[] = Page\buttonLink('Show Archived Contacts', '?all=1');
}

include_once '../../fns/Page/imageArrowLink.php';
$title = 'Delete All Contacts';
$deleteAllLink = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

include_once '../../fns/create_new_item_button.php';
include_once '../../fns/create_panel.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Contacts',
            'href' => '..',
        ],
    ],
    'Received',
    Page\sessionMessages('contacts/received/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', $deleteAllLink),
    create_new_item_button('Contact', '../')
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Contacts', $content, '../../');
