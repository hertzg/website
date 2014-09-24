<?php

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($folder, $id, $username, $user, $values) = require_recipient($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['files/send-folder/errors'],
    $_SESSION['files/send-folder/messages']
);

$params = ['id_folders' => $id];
$recipients = $values['recipients'];

include_once "$fnsDir/Contacts/indexWithUsernameOnUser.php";
$contacts = Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

$yesHref = 'submit.php?'.htmlspecialchars(http_build_query([
    'id_folders' => $id,
    'username' => $username,
]));

include_once "$fnsDir/Page/confirmDialog.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/warnings.php";
include_once "$fnsDir/SendForm/recipientsPanels.php";
$content =
    Page\tabs(
        [
            [
                'title' => 'Files',
                'href' => "../../?id_folders=$id",
            ],
        ],
        "Send Folder #$id",
        Page\warnings(['Send the folder to:'])
        .SendForm\recipientsPanels($recipients, $contacts, $params, '../')
    )
    .Page\confirmDialog('Are you sure you want to remove the recipient'
        .' "<b>'.htmlspecialchars($username).'</b>"?',
        'Yes, remove recipient', $yesHref, "../?id_folders=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Remove Recipient?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
