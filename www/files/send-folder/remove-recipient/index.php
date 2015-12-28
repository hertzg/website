<?php

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($folder, $id, $username, $user, $recipients) = require_recipient($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['files/send-folder/errors'],
    $_SESSION['files/send-folder/messages']
);

$params = ['id_folders' => $id];

include_once "$fnsDir/Contacts/indexWithUsernameOnUser.php";
$contacts = Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

$yesHref = 'submit.php?'.htmlspecialchars(http_build_query([
    'id_folders' => $id,
    'username' => $username,
]));

include_once "$fnsDir/Page/confirmDialog.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/text.php";
include_once "$fnsDir/SendForm/recipientsPanels.php";
$content =
    Page\create(
        [
            'title' => 'Files',
            'href' => "../../?id_folders=$id#send",
        ],
        "Send Folder #$id",
        Page\text('Send the folder to:')
        .SendForm\recipientsPanels($recipients, $contacts, $params, '../')
    )
    .Page\confirmDialog('Are you sure you want to remove the recipient'
        .' "<b>'.htmlspecialchars($username).'</b>"?',
        'Yes, remove recipient', $yesHref, "../?id_folders=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Remove Recipient?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
