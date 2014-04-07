<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

unset($_SESSION['contacts/view/messages']);

include_once '../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../../fns/Page/imageLink.php';

$href = "submit.php$escapedItemQuery";
$yesLink = Page\imageLink('Yes, delete contact', $href, 'yes');

$noLink = Page\imageLink('No, return back', "../view/$escapedItemQuery", 'no');

include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Contacts',
            'href' => ItemList\listHref(),
        ],
    ],
    "Contact #$id",
    Page\text(
        'Are you sure you want to delete the contact'
        .' "<b>'.htmlspecialchars($contact->full_name).'</b>"?'
    )
    .'<div class="hr"></div>'
    .Page\twoColumns($yesLink, $noLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Contact #$id?", $content, '../../');
