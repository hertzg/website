<?php

include_once '../../fns/require_contact.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli, '../');

include_once '../../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../../../fns/Page/imageLink.php';
$href = "submit.php$escapedItemQuery";
$yesLink = Page\imageLink('Yes, delete photo', $href, 'yes');

$href = "../../view/$escapedItemQuery";
$noLink = Page\imageLink('No, return back', $href, 'no');

include_once '../../../fns/ItemList/listHref.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../../home/',
        ],
        [
            'title' => 'Contacts',
            'href' => '../'.ItemList\listHref(),
        ]
    ],
    "Contact #$id",
    Page\text('Are you sure you want to delete the photo of the contact?')
    .'<div class="hr"></div>'
    .Page\twoColumns($yesLink, $noLink)
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete Contact Photo', $content, '../../../');
