<?php

namespace SendForm\NewItem;

function recipientsPage ($mysqli, $user,
    $pageTitle, $text, $errorsKey, $messagesKey, $valuesKey) {

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

    include_once __DIR__.'/../../Contacts/indexWithUsernameOnUser.php';
    $contacts = \Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

    include_once __DIR__.'/../../ItemList/pageParams.php';
    $pageParams = \ItemList\pageParams();

    if ($values['usernameError']) {
        $username = $values['username'];
        if ($contacts || $recipients) {
            include_once __DIR__.'/../../RecipientList/enterCancelForm.php';
            $content = \RecipientList\enterCancelForm($username, $pageParams);
        } else {
            include_once __DIR__.'/../../RecipientList/enterForm.php';
            $content = \RecipientList\enterForm($username, $pageParams, true);
        }
    } else {
        if ($recipients) {
            include_once __DIR__.'/../recipientsPanels.php';
            $content = \SendForm\recipientsPanels(
                $recipients, $contacts, $pageParams);
        } else {
            if ($contacts) {
                include_once __DIR__.'/../../RecipientList/contactsForm.php';
                include_once __DIR__.'/../../RecipientList/enterPanel.php';
                $content =
                    \RecipientList\contactsForm($contacts, $pageParams)
                    .\RecipientList\enterPanel('', $pageParams);
            } else {
                include_once __DIR__.'/../../RecipientList/enterForm.php';
                $content = \RecipientList\enterForm('', $pageParams, true);
            }
        }
    }

    include_once __DIR__.'/../../ItemList/escapedPageQuery.php';
    include_once __DIR__.'/../../Page/sessionErrors.php';
    include_once __DIR__.'/../../Page/sessionMessages.php';
    include_once __DIR__.'/../../Page/tabs.php';
    include_once __DIR__.'/../../Page/warnings.php';
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

    include_once __DIR__.'/../../echo_page.php';
    echo_page($user, $pageTitle, $content, '../../../');

}
