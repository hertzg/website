<?php

namespace SendForm\EditItem;

function removeRecipientPage ($mysqli, $user, $id,
    $username, $text, $recipients, $base, $contactsBase) {

    $base = '../../../../';
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/ItemList/itemQuery.php";
    $itemQuery = \ItemList\itemQuery($id);

    $escapedItemQuery = htmlspecialchars($itemQuery);

    include_once "$fnsDir/ItemList/itemParams.php";
    $itemParams = \ItemList\itemParams($id);
    $itemParams['username'] = $username;
    $yesHref = 'submit.php?'.htmlspecialchars(http_build_query($itemParams));

    include_once "$fnsDir/Contacts/indexWithUsernameOnUser.php";
    $contacts = \Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

    include_once __DIR__.'/../recipientsPanels.php';
    \SendForm\recipientsPanels($recipients, $contacts, $itemParams,
        $content, $additionalPanels, $base, $contactsBase, '../');

    include_once "$fnsDir/Page/confirmDialog.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/text.php";
    $content =
        \Page\create(
            [
                'title' => 'Edit',
                'href' => "../../$escapedItemQuery",
            ],
            'Send',
            \Page\text("Send the edited $text to:").$content
        )
        .$additionalPanels
        .\Page\confirmDialog('Are you sure you want to remove the recipient'
            .' "<b>'.htmlspecialchars($username).'</b>"?',
            'Yes, remove recipient', $yesHref, "../$escapedItemQuery");

    include_once "$fnsDir/compressed_css_link.php";
    include_once "$fnsDir/echo_user_page.php";
    echo_user_page($user, 'Remove Recipient?', $content, $base, [
        'head' => compressed_css_link('confirmDialog', $base),
    ]);

}
