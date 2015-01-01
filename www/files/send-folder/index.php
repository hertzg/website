<?php

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id, $user) = require_folder($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['files/messages']);

$key = 'files/send-folder/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'recipients' => [],
        'username' => '',
        'usernameError' => false,
    ];
}

$params = ['id_folders' => $id];
$recipients = $values['recipients'];

include_once "$fnsDir/Contacts/indexWithUsernameOnUser.php";
$contacts = Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

if ($values['usernameError']) {
    $username = $values['username'];
    if ($contacts || $recipients) {
        include_once "$fnsDir/RecipientList/enterCancelForm.php";
        $content = RecipientList\enterCancelForm($username, $params);
    } else {
        include_once "$fnsDir/RecipientList/enterForm.php";
        $content = RecipientList\enterForm($username, $params, true);
    }
} else {
    if ($recipients) {
        include_once "$fnsDir/SendForm/recipientsPanels.php";
        $content = SendForm\recipientsPanels($recipients, $contacts, $params);
    } else {
        if ($contacts) {
            include_once "$fnsDir/RecipientList/contactsForm.php";
            include_once "$fnsDir/RecipientList/enterPanel.php";
            $content =
                RecipientList\contactsForm($contacts, $params)
                .RecipientList\enterPanel('', $params);
        } else {
            include_once "$fnsDir/RecipientList/enterForm.php";
            $content = RecipientList\enterForm('', $params, true);
        }
    }
}

include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/warnings.php";
$content = Page\tabs(
    [
        [
            'title' => 'Files',
            'href' => "../?id_folders=$id#send",
        ],
    ],
    "Send Folder #$id",
    Page\sessionErrors('files/send-folder/errors')
    .Page\sessionMessages('files/send-folder/messages')
    .Page\warnings(['Send the folder to:'])
    .$content
);

include_once "$fnsDir/SendForm/removeDialog.php";
SendForm\removeDialog($recipients, $base, $content, $head);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Send Folder #$id", $content, $base, [
    'head' => $head,
]);
