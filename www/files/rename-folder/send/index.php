<?php

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id, $folder) = require_stage($mysqli);

$key = 'files/rename-folder/send/values';
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

include_once '../../../fns/Contacts/indexWithUsernameOnUser.php';
$contacts = Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

$params = ['id_folders' => $id];

if ($values['usernameError']) {
    $username = $values['username'];
    if ($contacts || $recipients) {
        include_once '../../../fns/RecipientList/enterCancelForm.php';
        $content = RecipientList\enterCancelForm($username, $params);
    } else {
        include_once '../../../fns/RecipientList/enterForm.php';
        $content = RecipientList\enterForm($username, $params, true);
    }
} else {
    if ($recipients) {

        include_once '../../../fns/SendForm/renderRecipientsPanel.php';
        $content = SendForm\renderRecipientsPanel($recipients, $params);

        include_once '../../../fns/RecipientList/enterPanel.php';
        if ($contacts) {
            include_once '../../../fns/RecipientList/contactsPanel.php';
            $content .= RecipientList\contactsPanel(
                $contacts, $params);
        }
        $content .= RecipientList\enterPanel('', $params);

    } else {
        if ($contacts) {
            include_once '../../../fns/RecipientList/contactsForm.php';
            include_once '../../../fns/RecipientList/enterPanel.php';
            $content =
                RecipientList\contactsForm($contacts, $params)
                .\RecipientList\enterPanel('', $params);
        } else {
            include_once '../../../fns/RecipientList/enterForm.php';
            $content = RecipientList\enterForm('', $params, true);
        }
    }
}

include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/sessionMessages.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/warnings.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => "../../?id_folders=$id",
        ],
        [
            'title' => "Rename Folder #$id",
            'href' => "../?id_folders=$id",
        ],
    ],
    'Send',
    Page\sessionErrors('files/rename-folder/send/errors')
    .\Page\sessionMessages('files/rename-folder/send/messages')
    .\Page\warnings(['Send the renamed folder to:'])
    .$content
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Send Renamed Folder', $content, '../../../');
