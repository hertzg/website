<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id, $file) = require_stage($mysqli);

$base = '../../../';
$contactsBase = "{$base}contacts/";
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

$additionalPanels = '';
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
        SendForm\recipientsPanels($recipients, $contacts,
            $params, $content, $additionalPanels, $base, $contactsBase);
    } else {
        if ($contacts) {

            include_once "$fnsDir/RecipientList/contactsForm.php";
            $content = RecipientList\contactsForm(
                $contacts, $params, $base, $contactsBase);

            include_once "$fnsDir/RecipientList/enterPanel.php";
            $additionalPanels = RecipientList\enterPanel('', $params);

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
$content =
    Page\create(
        [
            'title' => 'Rename',
            'href' => "../?id=$id",
        ],
        'Send',
        Page\sessionErrors('files/rename-file/send/errors')
        .Page\sessionMessages('files/rename-file/send/messages')
        .Page\text('Send the renamed file to:')
        .$content
    )
    .$additionalPanels;

include_once "$fnsDir/SendForm/removeDialog.php";
SendForm\removeDialog($recipients, $base, $head, $scripts);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Send Renamed File', $content, $base, [
    'head' => $head,
    'scripts' => $scripts,
]);
