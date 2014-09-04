<?php

namespace SendForm\EditItem;

function recipientsPage ($mysqli, $user, $id, $pageTitle,
    $text, $errorsKey, $messagesKey, $valuesKey) {

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

    include_once __DIR__.'/../../ItemList/itemParams.php';
    $itemParams = \ItemList\itemParams($id);

    include_once __DIR__.'/../../ItemList/escapedItemQuery.php';
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    if ($values['usernameError']) {
        $username = $values['username'];
        if ($contacts || $recipients) {
            include_once __DIR__.'/../../RecipientList/enterCancelForm.php';
            $content = \RecipientList\enterCancelForm($username, $itemParams);
        } else {
            include_once __DIR__.'/../../RecipientList/enterForm.php';
            $content = \RecipientList\enterForm($username, $itemParams, true);
        }
    } else {
        if ($recipients) {

            include_once __DIR__.'/../renderRecipientsPanel.php';
            $content = \SendForm\renderRecipientsPanel($recipients, $itemParams);

            include_once __DIR__.'/../../RecipientList/enterPanel.php';
            if ($contacts) {
                include_once __DIR__.'/../../RecipientList/contactsPanel.php';
                $content .= \RecipientList\contactsPanel(
                    $contacts, $itemParams);
            }
            $content .= \RecipientList\enterPanel('', $itemParams);

        } else {
            if ($contacts) {
                include_once __DIR__.'/../../RecipientList/contactsForm.php';
                include_once __DIR__.'/../../RecipientList/enterPanel.php';
                $content =
                    \RecipientList\contactsForm($contacts, $itemParams)
                    .\RecipientList\enterPanel('', $itemParams);
            } else {
                include_once __DIR__.'/../../RecipientList/enterForm.php';
                $content = \RecipientList\enterForm('', $itemParams, true);
            }
        }
    }

    include_once __DIR__.'/../../Page/sessionErrors.php';
    include_once __DIR__.'/../../Page/sessionMessages.php';
    include_once __DIR__.'/../../Page/tabs.php';
    include_once __DIR__.'/../../Page/warnings.php';
    $content = \Page\tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => "../../view/$escapedItemQuery",
            ],
            [
                'title' => 'Edit',
                'href' => "../$escapedItemQuery",
            ],
        ],
        'Send',
        \Page\sessionErrors($errorsKey)
        .\Page\sessionMessages($messagesKey)
        .\Page\warnings(["Send the edited $text to:"])
        .$content
    );

    include_once __DIR__.'/../../echo_page.php';
    echo_page($user, $pageTitle, $content, '../../../');

}
