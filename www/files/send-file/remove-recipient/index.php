<?php

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($file, $id, $username, $user, $recipients) = require_recipient($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['files/send-file/errors'],
    $_SESSION['files/send-file/messages']
);

$params = ['id_folders' => $id];

include_once "$fnsDir/Contacts/indexWithUsernameOnUser.php";
$contacts = Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

$yesHref = 'submit.php?'.htmlspecialchars(http_build_query([
    'id' => $id,
    'username' => $username,
]));

include_once "$fnsDir/Page/confirmDialog.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/text.php";
include_once "$fnsDir/SendForm/recipientsPanels.php";
$content =
    Page\tabs(
        [
            [
                'title' => "File #$id",
                'href' => "../../view-file/?id=$id#send",
            ],
        ],
        'Send',
        Page\text('Send the file to:')
        .SendForm\recipientsPanels($recipients, $contacts, $params, '../')
    )
    .Page\confirmDialog('Are you sure you want to remove the recipient'
        .' "<b>'.htmlspecialchars($username).'</b>"?', 'Yes, remove recipient',
        $yesHref, "../?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Remove Recipient?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
