<?php

include_once 'fns/require_received_contacts.php';
$user = require_received_contacts();

unset(
    $_SESSION['contacts/errors'],
    $_SESSION['contacts/messages'],
    $_SESSION['contacts/received/view/messages']
);

include_once '../../fns/ReceivedContacts/indexOnReceiver.php';
include_once '../../lib/mysqli.php';
$receivedContacts = ReceivedContacts\indexOnReceiver($mysqli, $user->id_users);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageArrowLinkWithDescription.php';

$items = [];
foreach ($receivedContacts as $receivedContact) {

    $href = "view/?id=$receivedContact->id";
    $alias = $receivedContact->alias;
    $title = htmlspecialchars($receivedContact->full_name);

    if ($receivedContact->favorite) $icon = 'favorite-contact';
    else $icon = 'contact';

    if ($alias === '') {
        $items[] = Page\imageArrowLink($title, $href, $icon);
    } else {
        $description = htmlspecialchars($alias);
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    }

}

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
