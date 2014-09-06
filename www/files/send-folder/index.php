<?php

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id, $user) = require_folder($mysqli);

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

$recipients = $values['recipients'];

include_once '../../fns/Contacts/indexWithUsernameOnUser.php';
$contacts = Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

$params = ['id_folders' => $id];

if ($values['usernameError']) {
    $username = $values['username'];
    if ($contacts || $recipients) {
        include_once '../../fns/RecipientList/enterCancelForm.php';
        $content = RecipientList\enterCancelForm($username, $params);
    } else {
        include_once '../../fns/RecipientList/enterForm.php';
        $content = RecipientList\enterForm($username, $params, true);
    }
} else {
    if ($recipients) {

        include_once __DIR__.'/../../fns/SendForm/renderRecipientsPanel.php';
        $content = SendForm\renderRecipientsPanel($recipients, $params);

        include_once '../../fns/RecipientList/enterPanel.php';
        if ($contacts) {
            include_once '../../fns/RecipientList/contactsPanel.php';
            $content .= RecipientList\contactsPanel($contacts, $params);
        }
        $content .= RecipientList\enterPanel('', $params);

    } else {
        if ($contacts) {
            include_once '../../fns/RecipientList/contactsForm.php';
            include_once '../../fns/RecipientList/enterPanel.php';
            $content =
                RecipientList\contactsForm($contacts, $params)
                .\RecipientList\enterPanel('', $params);
        } else {
            include_once '../../fns/RecipientList/enterForm.php';
            $content = RecipientList\enterForm('', $params, true);
        }
    }
}

include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/warnings.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Files',
            'href' => "../?id_folders=$id",
        ],
    ],
    "Send Folder #$id",
    Page\sessionErrors('files/send-folder/errors')
    .\Page\sessionMessages('files/send-folder/messages')
    .\Page\warnings(['Send the file to:'])
    .$content
);

include_once '../../fns/echo_page.php';
echo_page($user, "Send File #$id", $content, '../../');
