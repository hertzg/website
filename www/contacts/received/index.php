<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

if (!$user->num_received_contacts) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

unset(
    $_SESSION['contacts/errors'],
    $_SESSION['contacts/messages']
);

include_once '../../fns/ReceivedContacts/indexOnReceiver.php';
include_once '../../lib/mysqli.php';
$receivedContacts = ReceivedContacts\indexOnReceiver($mysqli, $user->id_users);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageArrowLinkWithDescription.php';

$items = [];
$icon = 'contact';
foreach ($receivedContacts as $receivedContact) {
    $href = "view/?id=$receivedContact->id";
    $alias = $receivedContact->alias;
    $title = htmlspecialchars($receivedContact->full_name);
    if ($alias === '') {
        $items[] = Page\imageArrowLink($title, $href, $icon);
    } else {
        $description = htmlspecialchars($alias);
        $items[] = Page\imageArrowLinkWithDescription($title, $description, $href, $icon);
    }
}

include_once '../../fns/create_tabs.php';
$content = create_tabs(
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
    join('<div class="hr"></div>', $items)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Contacts', $content, $base);
