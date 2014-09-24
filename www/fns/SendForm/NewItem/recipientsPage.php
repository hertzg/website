<?php

namespace SendForm\NewItem;

function recipientsPage ($mysqli, $user,
    $pageTitle, $text, $errorsKey, $messagesKey, $valuesKey) {

    $base = '../../../';
    $fnsDir = __DIR__.'/../..';

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

    include_once "$fnsDir/ItemList/pageParams.php";
    $pageParams = \ItemList\pageParams();

    if ($values['usernameError']) {
        $username = $values['username'];
        if ($contacts || $recipients) {
            include_once "$fnsDir/RecipientList/enterCancelForm.php";
            $content = \RecipientList\enterCancelForm($username, $pageParams);
        } else {
            include_once "$fnsDir/RecipientList/enterForm.php";
            $content = \RecipientList\enterForm($username, $pageParams, true);
        }
    } else {
        if ($recipients) {
            include_once __DIR__.'/../recipientsPanels.php';
            $content = \SendForm\recipientsPanels(
                $recipients, $contacts, $pageParams);
        } else {
            if ($contacts) {
                include_once "$fnsDir/RecipientList/contactsForm.php";
                include_once "$fnsDir/RecipientList/enterPanel.php";
                $content =
                    \RecipientList\contactsForm($contacts, $pageParams)
                    .\RecipientList\enterPanel('', $pageParams);
            } else {
                include_once "$fnsDir/RecipientList/enterForm.php";
                $content = \RecipientList\enterForm('', $pageParams, true);
            }
        }
    }

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/warnings.php";
    $content = \Page\tabs(
        [
            [
                'title' => 'New',
                'href' => '../'.\ItemList\escapedPageQuery(),
            ],
        ],
        'Send',
        \Page\sessionErrors($errorsKey)
        .\Page\sessionMessages($messagesKey)
        .\Page\warnings(["Send the new $text to:"])
        .$content
    );

    include_once "$fnsDir/SendForm/removeDialog.php";
    \SendForm\removeDialog($recipients, $base, $content, $head);

    include_once "$fnsDir/echo_page.php";
    echo_page($user, $pageTitle, $content, $base, ['head' => $head]);

}
