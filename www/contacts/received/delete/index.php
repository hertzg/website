<?php

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);

unset($_SESSION['contacts/received/view/messages']);

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Received',
            'href' => '..',
        ],
    ],
    "Received Contact #$id",
    Page\text('Are you sure you want to delete the contact?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete contact', "submit.php?id=$id", 'yes'),
        Page\imageLink('No, return back', "../view/?id=$id", 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete Received Contact #?', $content, '../../../');
