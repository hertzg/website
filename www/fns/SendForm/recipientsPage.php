<?php

namespace SendForm;

function recipientsPage ($mysqli, $user, $id, $tabTitle,
    $pageTitle, $text, $errorsKey, $messagesKey, $valuesKey) {

    $base = '../../';
    $fnsDir = __DIR__.'/..';

    if (array_key_exists($valuesKey, $_SESSION)) {
        $values = $_SESSION[$valuesKey];
    } else {
        $values = [
            'recipients' => [],
            'username' => '',
            'usernameError' => false,
        ];
    }

    $recipients = $values['recipients'];

    include_once "$fnsDir/Contacts/indexWithUsernameOnUser.php";
    $contacts = \Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

    include_once "$fnsDir/ItemList/itemParams.php";
    $itemParams = \ItemList\itemParams($id);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    if ($values['usernameError']) {
        $username = $values['username'];
        if ($contacts || $recipients) {
            include_once "$fnsDir/RecipientList/enterCancelForm.php";
            $content = \RecipientList\enterCancelForm($username, $itemParams);
        } else {
            include_once "$fnsDir/RecipientList/enterForm.php";
            $content = \RecipientList\enterForm($username, $itemParams, true);
        }
    } else {
        if ($recipients) {
            include_once __DIR__.'/recipientsPanels.php';
            $content = recipientsPanels($recipients, $contacts, $itemParams);
        } else {
            if ($contacts) {
                include_once "$fnsDir/RecipientList/contactsForm.php";
                include_once "$fnsDir/RecipientList/enterPanel.php";
                $content =
                    \RecipientList\contactsForm($contacts, $itemParams)
                    .\RecipientList\enterPanel('', $itemParams);
            } else {
                include_once "$fnsDir/RecipientList/enterForm.php";
                $content = \RecipientList\enterForm('', $itemParams, true);
            }
        }
    }

    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/warnings.php";
    $content = \Page\tabs(
        [
            [
                'title' => $tabTitle,
                'href' => "../view/$escapedItemQuery",
            ],
        ],
        'Send',
        \Page\sessionErrors($errorsKey)
        .\Page\sessionMessages($messagesKey)
        .\Page\warnings(["Send the $text to:"])
        .$content
    );

    include_once __DIR__.'/removeDialog.php';
    removeDialog($recipients, $base, $content, $head);

    include_once "$fnsDir/echo_page.php";
    echo_page($user, $pageTitle, $content, $base, ['head' => $head]);

}
