<?php

namespace SendForm\NewItem;

function recipientsPage ($mysqli, $user, $what_upper, $what_lower,
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

    include_once "$fnsDir/ItemList/pageParams.php";
    $pageParams = \ItemList\pageParams();

    $additionalPanels = '';
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
            \SendForm\recipientsPanels($recipients, $contacts, $pageParams,
                $content, $additionalPanels, $base, $contactsBase);
        } else {
            if ($contacts) {

                include_once "$fnsDir/RecipientList/contactsForm.php";
                $content = \RecipientList\contactsForm(
                    $contacts, $pageParams, $base, $contactsBase);

                include_once "$fnsDir/RecipientList/enterPanel.php";
                $additionalPanels = \RecipientList\enterPanel('', $pageParams);

            } else {
                include_once "$fnsDir/RecipientList/enterForm.php";
                $content = \RecipientList\enterForm('', $pageParams, true);
            }
        }
    }

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/text.php";
    $content =
        \Page\create(
            [
                'title' => "New $what_upper",
                'href' => '../'.\ItemList\escapedPageQuery(),
            ],
            'Send',
            \Page\sessionErrors($errorsKey)
            .\Page\sessionMessages($messagesKey)
            .\Page\text("Send the new $what_lower to:")
            .$content
        )
        .$additionalPanels;

    include_once "$fnsDir/SendForm/removeDialog.php";
    \SendForm\removeDialog($recipients, $base, $head, $scripts);

    include_once "$fnsDir/echo_user_page.php";
    echo_user_page($user, "Send New $what_upper", $content, $base, [
        'head' => $head,
        'scripts' => $scripts,
    ]);

}
