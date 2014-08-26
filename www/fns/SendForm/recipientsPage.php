<?php

namespace SendForm;

function recipientsPage ($mysqli, $user, $id, $title,
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

    include_once '../../fns/Contacts/indexWithUsernameOnUser.php';
    $contacts = \Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

    include_once '../../fns/ItemList/itemParams.php';
    $itemParams = \ItemList\itemParams($id);

    include_once '../../fns/ItemList/escapedItemQuery.php';
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    if ($values['usernameError']) {
        $username = $values['username'];
        if ($contacts || $recipients) {
            include_once '../../fns/RecipientList/enterCancelForm.php';
            $content = \RecipientList\enterCancelForm($username, $itemParams);
        } else {
            include_once '../../fns/RecipientList/enterForm.php';
            $content = \RecipientList\enterForm($username, $itemParams, true);
        }
    } else {
        if ($recipients) {

            include_once '../../fns/Page/imageLink.php';
            $content = '';
            foreach ($recipients as $recipient) {
                $username = htmlspecialchars($recipient);
                $href = 'remove-recipient/?'.htmlspecialchars(
                    http_build_query(
                        array_merge($itemParams, [
                            'username' => $recipient,
                        ])
                    )
                );
                $content .=
                    \Page\imageLink($username, $href, 'contact')
                    .'<div class="hr"></div>';
            }

            include_once '../../fns/Page/buttonLink.php';
            $href = "submit-send.php$escapedItemQuery";
            $content .= \Page\buttonLink('Send', $href);

            include_once '../../fns/RecipientList/enterPanel.php';
            if ($contacts) {
                include_once '../../fns/RecipientList/contactsPanel.php';
                $content .= \RecipientList\contactsPanel(
                    $contacts, $itemParams);
            }
            $content .= \RecipientList\enterPanel('', $itemParams);

        } else {
            if ($contacts) {
                include_once '../../fns/RecipientList/contactsForm.php';
                include_once '../../fns/RecipientList/enterPanel.php';
                $content =
                    \RecipientList\contactsForm($contacts, $itemParams)
                    .\RecipientList\enterPanel('', $itemParams);
            } else {
                include_once '../../fns/RecipientList/enterForm.php';
                $content = \RecipientList\enterForm('', $itemParams, true);
            }
        }
    }

    include_once '../../fns/ItemList/listHref.php';
    include_once '../../fns/Page/sessionErrors.php';
    include_once '../../fns/Page/sessionMessages.php';
    include_once '../../fns/Page/tabs.php';
    include_once '../../fns/Page/warnings.php';
    $content = \Page\tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => \ItemList\listHref(),
            ],
            [
                'title' => $title,
                'href' => "../view/$escapedItemQuery",
            ],
        ],
        'Send',
        \Page\sessionErrors($errorsKey)
        .\Page\sessionMessages($messagesKey)
        .\Page\warnings(["Send the $text to:"])
        .$content
    );

    include_once '../../fns/echo_page.php';
    echo_page($user, "Send Bookmark #$id", $content, '../../');

}
