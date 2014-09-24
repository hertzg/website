<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['files/view-file/messages']);

$key = 'files/send-file/values';
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
        include_once 'fns/recipients_page.php';
        $content = recipients_page($recipients, $contacts, $params);
    } else {
        if ($contacts) {
            include_once "$fnsDir/RecipientList/contactsForm.php";
            include_once "$fnsDir/RecipientList/enterPanel.php";
            $content =
                RecipientList\contactsForm($contacts, $params)
                .\RecipientList\enterPanel('', $params);
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
            'title' => "File #$id",
            'href' => "../view-file/?id=$id",
        ],
    ],
    'Send',
    Page\sessionErrors('files/send-file/errors')
    .\Page\sessionMessages('files/send-file/messages')
    .\Page\warnings(['Send the file to:'])
    .$content
);

if ($recipients) {

    include_once "$fnsDir/compressed_js_script.php";
    $content .=
        compressed_js_script('confirmDialog', $base)
        .compressed_js_script('removeRecipient', $base);

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('confirmDialog', $base);

} else {
    $head = '';
}

include_once "$fnsDir/echo_page.php";
echo_page($user, "Send File #$id", $content, $base, [
    'head' => $head,
]);
