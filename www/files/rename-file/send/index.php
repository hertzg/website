<?php

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id, $file) = require_stage($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

$key = 'files/rename-file/send/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'recipients' => [],
        'username' => '',
        'usernameError' => false,
    ];
}

$recipients = $values['recipients'];

include_once "$fnsDir/Contacts/indexWithUsernameOnUser.php";
$contacts = Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

$params = ['id' => $id];

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

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/text.php";
$content = Page\create(
    [
        'title' => 'Rename',
        'href' => "../?id=$id",
    ],
    'Send',
    Page\sessionErrors('files/rename-file/send/errors')
    .Page\sessionMessages('files/rename-file/send/messages')
    .Page\text('Send the renamed file to:')
    .$content
);

include_once "$fnsDir/SendForm/removeDialog.php";
SendForm\removeDialog($recipients, $base, $content, $head);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Send Renamed File', $content, $base, [
    'head' => $head,
]);
