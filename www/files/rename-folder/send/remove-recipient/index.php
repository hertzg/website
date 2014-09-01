<?php

include_once 'fns/require_recipient.php';
include_once '../../../../lib/mysqli.php';
list($folder, $id, $username, $user) = require_recipient($mysqli);

unset(
    $_SESSION['files/rename-folder/send/errors'],
    $_SESSION['files/rename-folder/send/messages']
);

$yesHref = 'submit.php?'.htmlspecialchars(http_build_query([
    'id_folders' => $id,
    'username' => $username,
]));

include_once '../../../../fns/Page/imageLink.php';
include_once '../../../../fns/Page/tabs.php';
include_once '../../../../fns/Page/text.php';
include_once '../../../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => "../../../?id_folders=$id",
        ],
        [
            'title' => "Rename Folder #$id",
            'href' => "../../?id_folders=$id",
        ],
    ],
    'Send',
    Page\text('Are you sure you want to remove the recipient'
        .' "<b>'.htmlspecialchars($username).'</b>"?')
    .'<div class="hr"></div>'
    .\Page\twoColumns(
        Page\imageLink('Yes, remove recipient', $yesHref, 'yes'),
        Page\imageLink('No, return back', "../?id_folders=$id", 'no')
    )
);

include_once '../../../../fns/echo_page.php';
echo_page($user, 'Remove Recipient', $content, '../../../../');
