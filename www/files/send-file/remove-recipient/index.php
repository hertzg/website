<?php

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($file, $id, $username, $user) = require_recipient($mysqli);

unset(
    $_SESSION['files/send-file/errors'],
    $_SESSION['files/send-file/messages']
);

$yesHref = 'submit.php?'.htmlspecialchars(http_build_query([
    'id' => $id,
    'username' => $username,
]));

$listHref = '../..';
$id_folders = $file->id_folders;
if ($id_folders) $listHref .= "/?id_folders=$id_folders";

include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => $listHref,
        ],
        [
            'title' => "File #$id",
            'href' => "../../view-file/?id=$id",
        ],
    ],
    'Send',
    Page\text('Are you sure you want to remove the recipient'
        .' "<b>'.htmlspecialchars($username).'</b>"?')
    .'<div class="hr"></div>'
    .\Page\twoColumns(
        Page\imageLink('Yes, remove recipient', $yesHref, 'yes'),
        Page\imageLink('No, return back', "../?id=$id", 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Remove Recipient?', $content, '../../../');
