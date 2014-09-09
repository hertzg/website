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
foreach ($receivedContacts as $receivedContact) {

    if ($receivedContact->favorite) $icon = 'favorite-contact';
    else $icon = 'contact';

    $title = htmlspecialchars($receivedContact->full_name);
    $description = create_sender_description($receivedContact);
    $href = "view/?id=$receivedContact->id";
    $items[] = Page\imageArrowLinkWithDescription($title,
        $description, $href, $icon);

}
if (!$all && $user->num_archived_received_contacts) {
    include_once '../../fns/Form/button.php';
    $items[] =
        '<form action="./">'
            .Form\button('Show Archived Contacts')
            .'<input type="hidden" name="all" value="1" />'
        .'</form>';
}

include_once '../../fns/Page/imageArrowLink.php';
$title = 'Delete All Contacts';
$deleteAllLink = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/sessionMessages.php';
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
    .create_panel('Options', $deleteAllLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Contacts', $content, '../../');
