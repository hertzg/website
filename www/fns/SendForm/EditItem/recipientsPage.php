<?php

namespace SendForm\EditItem;

function recipientsPage ($mysqli, $user, $id, $pageTitle, $text,
    $errorsKey, $messagesKey, $valuesKey, $base, $contactsBase) {

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

    include_once "$fnsDir/ItemList/itemParams.php";
    $itemParams = \ItemList\itemParams($id);

    $additionalPanels = '';
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
            include_once __DIR__.'/../recipientsPanels.php';
            \SendForm\recipientsPanels($recipients, $contacts, $itemParams,
                $content, $additionalPanels, $base, $contactsBase);
        } else {
            if ($contacts) {

                include_once "$fnsDir/RecipientList/contactsForm.php";
                $content = \RecipientList\contactsForm(
                    $contacts, $itemParams, $base, $contactsBase);

                include_once "$fnsDir/RecipientList/enterPanel.php";
                $additionalPanels = \RecipientList\enterPanel('', $itemParams);

            } else {
                include_once "$fnsDir/RecipientList/enterForm.php";
                $content = \RecipientList\enterForm('', $itemParams, true);
            }
        }
    }

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/text.php";
    $content =
        \Page\create(
            [
                'title' => 'Edit',
                'href' => '../'.\ItemList\escapedItemQuery($id),
            ],
            'Send',
            \Page\sessionErrors($errorsKey)
            .\Page\sessionMessages($messagesKey)
            .\Page\text("Send the edited $text to:")
            .$content
        )
        .$additionalPanels;

    include_once "$fnsDir/SendForm/removeDialog.php";
    \SendForm\removeDialog($recipients, $base, $head, $scripts);

    include_once "$fnsDir/echo_user_page.php";
    echo_user_page($user, $pageTitle, $content, $base, [
        'head' => $head,
        'scripts' => $scripts,
    ]);

}
