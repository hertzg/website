<?php

include_once '../fns/require_received_contacts.php';
$user = require_received_contacts('../');

unset($_SESSION['contacts/received/messages']);

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => 'Contacts',
            'href' => '../..',
        ],
    ],
    'Received',
    Page\text('Are you sure you want to delete all the received contacts?'
        .' They will be moved to Trash.')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete all contacts', 'submit.php', 'yes'),
        Page\imageLink('No, return back', '..', 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete All Received Contacts?', $content, '../../../');
