<?php

include_once '../../../../../lib/defaults.php';

include_once 'fns/require_recipient.php';
include_once '../../../../lib/mysqli.php';
list($folder, $id, $username, $user, $recipients) = require_recipient($mysqli);

$base = '../../../../';
$fnsDir = '../../../../fns';

unset(
    $_SESSION['files/rename-folder/send/errors'],
    $_SESSION['files/rename-folder/send/messages']
);

$params = ['id_folders' => $id];

include_once "$fnsDir/Contacts/indexWithUsernameOnUser.php";
$contacts = Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

$yesHref = 'submit.php?'.htmlspecialchars(http_build_query([
    'id_folders' => $id,
    'username' => $username,
]));

include_once "$fnsDir/SendForm/recipientsPanels.php";
SendForm\recipientsPanels($recipients, $contacts,
    $params, $content, $additionalPanels, '../');

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/confirmDialog.php";
include_once "$fnsDir/Page/text.php";
$content =
    Page\create(
        [
            'title' => "Rename Folder #$id",
            'href' => "../../?id_folders=$id",
        ],
        'Send',
        Page\text('Send the renamed folder to:').$content
    )
    .$additionalPanels
    .Page\confirmDialog('Are you sure you want to remove the recipient'
        .' "<b>'.htmlspecialchars($username).'</b>"?', 'Yes, remove recipient',
        $yesHref, "../?id_folders=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Remove Recipient?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
